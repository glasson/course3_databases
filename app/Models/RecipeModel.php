<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeModel extends Model
{
    use HasFactory;
    protected $table = 'client_recipe';
    public $timestamps = false;
}
