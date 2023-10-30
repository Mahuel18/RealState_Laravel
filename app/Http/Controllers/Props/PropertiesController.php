<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;

class PropertiesController extends Controller
{
    //
    public function index(){

        $props = Property::select()->take(9)->orderBy('Created_at', 'desc')->get();

        return view('home', compact('props'));
    }
}
