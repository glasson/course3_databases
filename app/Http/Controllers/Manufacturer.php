<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer as ManModel;
use Illuminate\Http\Request;

class Manufacturer extends Controller
{
    public function get(){
        return ManModel::all();
    }

    public function add(Request $request){
        $t = new ManModel();
        $t->name = $request->input('name');
        $t->save();
        return 'success';
    }

}
