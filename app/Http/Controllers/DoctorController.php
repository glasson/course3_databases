<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Polyclinic;

class DoctorController extends Controller
{
    function get(){
        $doctors_and_polyclinics=[];
        $doctors=Doctor::all();
        foreach($doctors as $doctor){
            $polyclinic = Polyclinic::find($doctor->polyclinic_id);
            $tmp = [
                'name' => sprintf('%s %s %s' ,$doctor->name , $doctor->surname , $doctor->patronymic) ,
                'polyclinic'=> $polyclinic->name,
                'id'=> $doctor->id
            ];
            array_push($doctors_and_polyclinics, $tmp);
        }
        return $doctors_and_polyclinics;
    }

    function find(Request $request){
        $doctor = Doctor::find($request->input('id'));
        $polyclinic = Polyclinic::find($doctor->polyclinic_id);
        return [
            'name' => sprintf('%s %s %s' ,$doctor->name , $doctor->surname , $doctor->patronymic) ,
            'polyclinic'=> $polyclinic->name,
            'id'=> $doctor->id
        ];
    }
}
