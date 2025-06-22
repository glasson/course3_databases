<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sell;
use App\Models\SoldProduct;
use App\Models\Client as ClientModel;
use DateTime, DateTimeZone;
use Exception;

class SellController extends Controller
{
    function add(Request $request){
        try{
            $sell = new Sell();
            $sell->pharmacist = $request->input('account_id');
            if ($request->has('phone')) 
                $sell->client = ClientModel::where('phone', $request->input('phone'))->first()->id;
            $currentDate = new DateTime();
            $currentDate->setTimezone( new DateTimeZone('Asia/Bangkok') );   
            $sell->date = $currentDate;
            $sell->save();

            $products = $request->input('products', []);
            foreach ($products as $product) {
                $id = $product['id'];
                $quantity = $product['quantity'];
                $product_sell = new SoldProduct();
                $product_sell->product_id = $id;
                $product_sell->quantity = $quantity;
                $product_sell->sell_id = $sell->id ;
                $product_sell->save();
            }
            return 'успешно';
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    
    function change(Request $request){

    }

    function delete(Request $request){

    }
}
