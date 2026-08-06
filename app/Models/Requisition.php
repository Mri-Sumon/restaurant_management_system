<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function requisitionDetails() {
        return $this->hasMany(RequisitionDetails::class)->with('material');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class)->select('id', 'code', 'name', 'phone', 'address', 'district_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class)->select('id', 'name', 'code');
    }

    public function user() {
        return $this->belongsTo(User::class, 'added_by', 'id')->select('id', 'name', 'phone');
    }
}
