<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion as PromotionModel;

class Promotion extends Controller
{
    function add(Request $request){
        $prom = new PromotionModel();
        $prom->product =  $request->input('product');
        $prom->discount = $request->input('discount');
        $prom->ending_date = $request->input('ending_date');
        $prom->description = $request->input('description');
        $prom->save();
        return $request;
    }

    function change(Request $request){

    }

    function delete(Request $request){

    }
}
