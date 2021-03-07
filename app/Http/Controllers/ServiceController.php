<?php

namespace App\Http\Controllers;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //view index page
    public function index()
    {
    return view('index');
   }
   
   //fetch services from database
   public function getServices(){
    //  $services = Services::orderby('id','asc')->select('*')->get(); 
     $services = Service::all(); 
     $response['data'] = $services; 
     return response()->json($response);
   }
}
