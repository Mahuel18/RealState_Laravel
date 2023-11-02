<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use App\Models\Prop\AllRequest;
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

        return view('props.single', compact('singleProp', 'propImages', 'relatedProps'));
    }

    public function insertRequests(Request $request){

        $insertRequest = AllRequest::create([
            'prop_id' => $request->prop_id, 
            'agent_name' => $request->agent_name,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
    }

}
