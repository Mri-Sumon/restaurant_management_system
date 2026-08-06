<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function bench() {
        return $this->belongsTo(Bench::class)->select('id', 'code', 'name');
    }

    public function serviceHead() {
        return $this->belongsTo(ServiceHead::class)->select('id', 'code', 'name');
    }
}
