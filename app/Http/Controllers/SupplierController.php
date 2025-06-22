<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function get(){
        return Supplier::all();
    }

    public function add(Request $request){
        $t = new Supplier();
        $t->name = $request->input('name');
        $t->save();
        return 'success';
    }
}
