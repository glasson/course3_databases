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
        $client = Client::where('phone', $request->input('phone'))->first();
        $recipe->client = $client->id;
        $recipe->series= $request->input('series');
        $recipe->number= $request->input('number');
        $recipe->save();
        return '200';
        }catch(Exception $exception){
            return $exception->getMessage();
        }
    }
}
