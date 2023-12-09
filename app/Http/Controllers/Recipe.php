<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientRecipe;
use App\Models\Client;
use Exception;

class Recipe extends Controller
{
    function add(Request $request){
        try{
            $recipe = new ClientRecipe();
            $recipe->doctor= $request->input('doctor_id');
            $recipe->medicine= $request->input('medicine_id');
            $client = Client::where('phone', $request->input('phone'))->first();// изменить эту строку
            $recipe->client = $client->id;
            $recipe->series= $request->input('series');
            $recipe->number= $request->input('number');
            $recipe->save();
            return '200';
        }
        catch(Exception $exception){
            return $exception->getMessage();
        }
    }

    function find(Request $request){
        $series = $request->input('series');
        $number = $request->input('number');
        $recipes = ClientRecipe::where('series', $series)->where('number', $number)->get();
        foreach ($recipes as $recipe){
            $recipe->client = Client::find($recipe->client)->phone;
        }
        return $recipes;
    }

    function change(Request $request){
        try{
            $recipe = ClientRecipe::find($request->input('recipe_id'));
            $recipe->doctor= $request->input('doctor_id');
            $recipe->medicine= $request->input('medicine_id');
             $client = Client::where('phone', $request->input('phone'))->first(); // изменить эту строку
             $recipe->client = $client->id;
            $recipe->series= $request->input('series');
            $recipe->number= $request->input('number');
            $recipe->save();
            return '200';
        }
        catch(Exception $exception){
            return $exception->getMessage();
        }
    }

    function delete(Request $request){
        ClientRecipe::find($request->input('recipe_id'))->delete();
        return 'успешно';
    }
}
