<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyModel extends Model
{
    use HasFactory;
    protected $table = 'apteka';
    public $timestamps = false;
}
