<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRecipe extends Model
{
    use HasFactory;
    protected $table = 'client_recipe';
    public $timestamps = false;
}
