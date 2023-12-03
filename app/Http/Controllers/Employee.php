<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as EmployeeModel;
use Exception;

class Employee extends Controller
{
    function add(Request $request){
        try{
            $employee = new EmployeeModel();
            $employee->name = $request->input('name');
            $employee->surname = $request->input('surname');
            $employee->patronymic = $request->input('patronymic');
            $employee->phone = $request->input('phone');
            $employee->apteka = $request->input('pharmacy_id');
            $employee->post = $request->input('role');
            $employee->password = $request->input('password');
            $employee->work_experience = $request->input('work_experience');
            $employee->save();
            return 'успешно';
        }catch(Exception $exception){
            return $exception->getMessage();
        }
    }
    function change(Request $request){

    }

    function delete(Request $request){

    }
}
