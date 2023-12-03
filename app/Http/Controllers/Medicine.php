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

    public function find(Request $request){
        $name_part = $request->input('name');
        return Med::where("name", 'like', '%'.$name_part.'%')->get();
    }

    function change(Request $request){
            $id = $request->input('id');
            $med = Med::find($id);
            $med->name = $request->input('name');
            $med->need_recipe = $request->input('need_recipe');
            $med->indications_for_use = $request->input('description');
            $med->form = $request->input('form');
            $med->save();
            return "успешно";
    }

    function delete(Request $request){
        $id = $request->input('id');
        Med::find($id)->delete();
        return 'успешно';
    }
}
