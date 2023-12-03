<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyModel;
use Exception;

class Pharmacy extends Controller
{
    function add (Request $request){
        try{
            $pharm = new PharmacyModel();
            $pharm->city = $request->input('city');
            $pharm->street = $request->input('street');
            $pharm->region = $request->input('region');
            $pharm->building_number = $request->input('building');
            $pharm->schedule = $request->input('schedule');
            
            $pharm->save();
            return $request;
        }catch(Exception $exception){
            return $exception->getMessage();
        }
    }
    
    function change(Request $request){

    }

    function delete(Request $request){

    }
}

