<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SuppliedProduct;
use App\Models\Supply as SupplyModel;
use Exception;
use Ramsey\Collection\Map\AssociativeArrayMap;

class Supply extends Controller
{
    function add (Request $request) {
        try{
            $supply = new SupplyModel();
            $supply->supplier = $request->input('supplier');
            $supply->supply_date = $request->input('supply_date');//date('d.m.Y');
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

    function find (Request $request){
        $date = $request->input("date");
        $pharmacy_id = $request->input("pharmacy_id");
        $supplies = SupplyModel::where("supply_date", $date)->where('pharmacy', $pharmacy_id)->get();
        $response=[];
        foreach($supplies as $supply){
            $suppliedProducts = SuppliedProduct::where('supply', $supply->id)->get();
            array_push($response, ['supply'=>$supply, 'suppliedProducts'=>$suppliedProducts]);
        }
        return $response;
    }

    function change(Request $request){

    }

    function delete_supply(Request $request){
        SupplyModel::destroy($request->input('id'));
        return '200';
    }
    function delete_supplied_product(Request $request){
        SuppliedProduct::destroy($request->input('id'));
        return '200';
    }
}
