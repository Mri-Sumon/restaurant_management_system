<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitionDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function requisition() {
        return $this->belongsTo(Requisition::class);
    }

    public function material() {
        return $this->belongsTo(Material::class, 'material_id', 'id')->with('unit');
    }
}
