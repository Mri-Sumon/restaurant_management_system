<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cocktails()
    {
        return $this->hasMany(Cocktail::class , 'cocktail_category_id');
    }
}
