<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client as ClientModel;

class Client extends Controller
{
    function getDiscount(Request $request){
        return ClientModel::where('phone', $request->input('phone')) -> first() -> discount;
    }
}
