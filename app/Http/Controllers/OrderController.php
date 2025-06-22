<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientOrder;
use App\Models\OrderedProduct;
use App\Models\Client;
use App\Models\Product;
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
                $product_order = new OrderedProduct();
                $product_order->order = $order->id ;
                $product_order->product = $product['id'];
                $product_order->quantity = $product['quantity'];
                $product_order->save();
            }

            return ['order_number'=>$order->id];
        }catch(Exception $e){
            error_log($e->getMessage());
            return "ошибка";
        }
    }

    function find(Request $request){
        return OrderedProduct::where('order', $request->input('id'))->get();
    }

    function change(Request $request){
        $order_number= $request->input('order_number');
        OrderedProduct::where('order', $order_number)->delete();

        $products = $request->input('new_ordered_products', []);
        foreach ($products as $product) {
            $product_order = new OrderedProduct();
            $product_order->order = $order_number;
            $product_order->product = $product['id'];
            $product_order->quantity = $product['quantity'];
            $product_order->save();
        }
        return 'успешно';

    }

    function delete(Request $request){
        $number = $request->input('order_number');
        $record = ClientOrder::find($number);//Сейчас номер это айди, изменить на уникальный номер
        if ($record) {
            $record->delete();
            return 'Запись успешно удалена';
        } else {
            return 'Запись не найдена';
        }
    }

    function client_order(Request $request){
        $phone = $request->input('phone');

        $order = new ClientOrder();
        $client = Client::where('phone', $phone)->first();
        $order->client = $client->id;
            
        $order->pharmacy_id = $request->input('pharmacy');

        $currentDate = new DateTime();
        $currentDate->setTimezone( new DateTimeZone('Asia/Bangkok') );    
        $order->order_date = $currentDate->format('Y-m-d H:i:s');

        $order->save();

        $product_order = new OrderedProduct();
        $product_order->order = $order->id ;
        
        $product_order->product = Product::where('name', $request->input('product'))->first()->id;
        $product_order->quantity = $request->input('quantity');
        $product_order->save();

        return $order->id;
    }

}
