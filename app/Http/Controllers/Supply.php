<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SuppliedProduct;
use App\Models\Supply as SupplyModel;
use Exception;

class Supply extends Controller
{
    function add (Request $request) {
        try{
            $supply = new SupplyModel();
            $supply->supplier = $request->input('supplier');
            $supply->supply_date = date('d.m.Y');
            $supply->pharmacy = $request->input('pharmacy_id');
            $supply->save();
            
            $products = $request->input('supplied_products', []);
            foreach($products as $product){
                $sp = new SuppliedProduct();
                $sp->supply = $supply->id;
                $sp->product_id = $product['id'];
                $sp->quantity = $product['quantity'];
                $sp->save();
            }
            return 'успешно';
        }
        catch(Exception $exception){
            return $exception->getMessage();
        }
    }

    function change(Request $request){

    }

    function delete(Request $request){

    }
}
