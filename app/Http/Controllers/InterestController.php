<?php

namespace App\Http\Controllers;

use App\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    //
    public function getInterests(){
        //  $services = Services::orderby('id','asc')->select('*')->get(); 
         $interests = Interest::all(); 
         $response['data'] = $interests; 
         return response()->json($response);
       }
}
