<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliedProduct extends Model
{
    use HasFactory;
    protected $table = 'supplied_product';
    public $timestamps = false;
}
