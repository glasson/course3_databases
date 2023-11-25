<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class Category extends Controller
{
    public function get(){
        return ProductCategory::all();
    }
}
