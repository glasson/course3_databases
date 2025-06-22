<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class Category extends Controller
{
    public function get(){
        return ProductCategory::all();
    }

    public function add(Request $request){
        $t = new ProductCategory();
        $t->name = $request->input('name');
        $t->save();
        return 'success';
    }
}
