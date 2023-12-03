<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Street;
use App\Models\Region;
use SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator;


class LocationController extends Controller
{
    function get(){
        return [
            'cities'=>City::all(),
            'streets'=>Street::all(),
            'regions'=>Region::all()
        ];
    }
}
