<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use Exception;

class Product extends Controller
{
    public function add(Request $request){
        //try{
            $p = new ProductModel();
            $p->apteka_id = $request->input('pharmacy_id');
            $p->name = $request->input('name');
            $p->medicine = $request->input('medicine');
            $p->category = $request->input('category');
            $p->manufacturer = $request->input('manufacturer');
            $p->price = $request->input('price');
            $p->quantity = $request->input('quantity');
            $p->expiration_date=$request->input('expiration_date');
            $p->volume = $request->input('volume');
            $p->save();
            return 'успешно';
        //}
        //catch(Exception $e){
        //    return 'ошибка';
        //}

    }

    public function getByPharmacyId($id) {
        return ProductModel::where('apteka_id', $id)->get();
    }
}
