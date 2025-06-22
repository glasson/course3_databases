<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Client;

class AuthController extends Controller
{
    public function auth(Request $request){
        $phone=$request->input('phone');
        $password=$request->input('password');
        $role=$request->input('role');

        if ($role != 1 ){
            $emp = Employee::where('phone', $phone)->where('password', $password)->where('post', $role);
            if($emp->exists())
                return ['name'=>$emp->first()->name, 'id'=>$emp->first()->id, 'pharmacy'=>$emp->first()->apteka];
            else{
                return ['message'=>'not found'];
            }
        }
        else {
            $client = Client::where('phone', $phone)->where('password', $password);
            if($client->exists())
                return ['name'=>$client->first()->name];
            else{
                return ['message'=>'not found'];
            }
        }
    }
}
