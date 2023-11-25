<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine as Med;
use Exception;

class Medicine extends Controller
{
    public function add(Request $request) {
        try{
            $med = new Med();
            $med->name = $request->input('name');
            $med->need_recipe = $request->input('need_recipe');
            $med->indications_for_use = $request->input('description');
            $med->form = $request->input('form');
            $med->save();
            return 'успешно';
        } 
        catch(Exception $e){
            return 'ошибка';
        }
    }

    public function get(){
        return Med::all();
    }
}
