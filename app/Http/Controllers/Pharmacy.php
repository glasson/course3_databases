<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyModel;
use App\Models\Street;
use App\Models\Region;
use App\Models\City;
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

    function find (Request $request){
        $full_address = explode(" ", $request->input('address') );
        $region =  $full_address[0] . " ". $full_address[1];
        $city = $full_address[2];
        $regionRecord = Region::where('name', $region)->first();
        $cityRecord = City::where('name', $city)->first();

        $pharmacies = PharmacyModel::where('region', $regionRecord->id)->where('city', $cityRecord->id)->get();
        foreach($pharmacies as $ph){
            $ph->region = $regionRecord->name;
            $ph->city = $cityRecord->name;
            $ph->street = Street::where('id', $ph->street)->first()->name;
        }
        return $pharmacies;
    }
    
    function change(Request $request){
        
    }

    function delete(Request $request){
        PharmacyModel::destroy($request->input('id'));
        return '200';
    }
}

