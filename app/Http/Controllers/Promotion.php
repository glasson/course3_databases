<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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

    function get(Request $request){
        $pr = PromotionModel::all();
        // foreach ($pr as $p){
        //     $p->product = Product::where('id', $p->product)->first()->name;
        // }
        return $pr;
    }

    function change(Request $request){  
        $id = $request->input('id');
        $prom = PromotionModel::find($id);
        $prom->product=$request->input('product');
        $prom->discount=$request->input('discount');
        $prom->description = $request->input('description');
        $prom->ending_date = $request->input('ending_date');
        $prom->save();
        return '200';
    }

    function delete(Request $request){
        PromotionModel::destroy($request->input('id'));
        return '200';
    }
}
