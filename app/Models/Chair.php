<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chair extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function table()
    {
        return $this->belongsTo(Bench::class, 'bench_id', 'id')->select('id', 'name', 'floor_id', 'incharge_id', 'bench_type_id');
    }
}
