<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer as ManModel;

class Manufacturer extends Controller
{
    public function get(){
        return ManModel::all();
    }
}
