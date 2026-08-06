<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailDesp extends Model
{
    use HasFactory;

    protected $fillable = ['description','cocktail_image','cocktail_video'];
}
