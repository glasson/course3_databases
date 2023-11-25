<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientOrder;
use App\Models\OrderedProduct;
use App\Models\Client;
use DateTime, DateTimeZone, Exception;

class OrderController extends Controller
{
    function add(Request $request) {
        try{
            $order = new ClientOrder();

            $phone = $request->input('phone');
            $client = Client::where('phone', $phone)->first();
            $order->client = $client->id;
            
            $order->pharmacy_id = $request->input('pharmacy_id');

            $currentDate = new DateTime();
            $currentDate->setTimezone( new DateTimeZone('UTC') );    
            $order->order_date = $currentDate->format('Y-m-d H:i:s');

            $order->save();

            $products = $request->input('products', []);
            foreach ($products as $product) {
                $id = $product['id'];
                $quantity = $product['quantity'];
                $product_order = new OrderedProduct();
                $product_order->product = $id;
                $product_order->quantity = $quantity;
                $product_order->order = $order->id ;
                $product_order->save();
            }

            return ['order_number'=>$order->id];
        }catch(Exception $e){
            error_log($e->getMessage());
            return "ошибка";
        }
    }

    function getOrderById($id){
        return OrderedProduct::where('order', $id)->get();
    }
}
