<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(CocktailCategory::class , 'cocktail_category_id')->select('id', 'name');
    }
}
