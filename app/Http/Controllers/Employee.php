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
            //return 'успешно';
        }
        catch(Exception $exception){
            return $exception->getMessage();
        }
    }

    function find(Request $request){
        $name = $request->input('name');
        $surname = $request->input('surname');
        $patronymic = $request->input('patronymic');
        $pharmacy_id = $request->input('pharmacy_id');
        if ($request->input('account_role') === 'admin')
            return EmployeeModel::where('name',$name)->where('surname',$surname)->where('patronymic',$patronymic)->get();
        else{
            return EmployeeModel::where('name',$name)->where('surname',$surname)->where('patronymic',$patronymic)->
                                    where('apteka', $pharmacy_id)->get(); 
        }
    }

    function change(Request $request){
        $employee = EmployeeModel::find($request->input('id'));
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
    }

    function delete(Request $request){
        EmployeeModel::find($request->input('id'))->delete();
        return "успешно";
    }
}
