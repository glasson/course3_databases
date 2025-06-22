<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request){
        $phone = $request->input('phone');
        $name = $request->input('name');
        $password = $request->input('password');
        $role = $request->input('role');
        if ($role != 1 ){
            $emp = new Employee();
            $emp->phone = $phone;
            $emp->name = explode(' ', $name)[1];
            $emp->surname = explode(' ', $name)[0];
            $emp->patronymic = explode(' ', $name)[2];
            $emp->password = $password;
            $emp->post = $role;
            $emp->apteka = $request->input('pharmacy');
            $emp->save();
        }
        else {
            $client = new Client();
            $client->phone = $phone;
            $client->name = explode(' ', $name)[1];
            $client->surname = explode(' ', $name)[0];
            $client->patronymic = explode(' ', $name)[2];
            $client->password = $password;
            $client->save();
        }
        return '200';
    }
}
