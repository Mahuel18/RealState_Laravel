<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use App\Models\Prop\AllRequest;
use App\Models\Prop\SavedProp;
use Auth;

class PropertiesController extends Controller
{
    //
    public function index(){

        $props = Property::select()->take(9)->orderBy('Created_at', 'desc')->get();

        return view('home', compact('props'));
    }

    public function single($id){

        $singleProp = Property::find($id);

        $propImages = PropImage::where('prop_id', $id)->get();

        //related props

        $relatedProps = Property::where('home_type', $singleProp->home_type)
        ->where('id', '!=', $id)
        ->take(3)
        ->orderBy('created_at', 'desc')
        ->get();

        //validating form request
        $validateFormCount = AllRequest::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();
        //validating Saved Props
        $validateSavedPropsCount = SavedProp::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();


        return view('props.single', compact('singleProp', 'propImages', 'relatedProps', 'validateFormCount', 'validateSavedPropsCount'));
    }

    public function insertRequests(Request $request){

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:70",
            "phone" => "required|max:50",
        ]);

        $insertRequest = AllRequest::create([
            'prop_id' => $request->prop_id, 
            'agent_name' => $request->agent_name,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if($insertRequest)

        return redirect('/props/prop-details/'.$request->prop_id)->with('success', 'Request added Successfully');
    }
    
    public function saveProps(Request $request){

        $saveProp = SavedProp::create([
            'prop_id' => $request->prop_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'image' => $request->image,
            'location' => $request->location,
            'price' => $request->price,

        ]);

        if($saveProp)

        return redirect('/props/prop-details/'.$request->prop_id)->with('success', 'Property saved Successfully');
    }

    public function propsBuy(){

        $type = "Buy";

        $propsBuy = Property::select()->where('type', $type)->get();

        return view('props.propsbuy', compact('propsBuy'));
    }

    public function propsRent(){

        $type = "Rent";

        $propsRent = Property::select()->where('type', $type)->get();

        return view('props.propsrent', compact('propsRent'));
    }

}