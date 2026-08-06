<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    function rel_to_menus()
    {
        return $this->hasMany(Menu::class, 'menu_category_id');
    }
}
