<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->select('id', 'name');
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id', 'id')->select('id', 'name', 'code');
    }


    public static function customerDue($clauses)
    {
        $due = DB::select("select 
                            o.id,
                            o.invoice,
                            o.total,
                            c.id as customer_id,
                            c.name,
                            c.phone,
                            (select o.total) as billAmount,
                            (select ifnull(sum(crp.amount), 0) from customer_payments crp 
                            where crp.order_id = o.id and crp.status = 'a') as cusPayment,
                            (select ifnull(sum(crp.discountAmount), 0) from customer_payments crp 
                            where crp.order_id = o.id and crp.status = 'a') as discountAmount,
                            (select o.paid + cusPayment) as paymentAmount,
                            (select billAmount - (paymentAmount + discountAmount)) as dueAmount
                            from orders o
                            left join customers c on c.id = o.customer_id
                            where o.status = 'a'
                        $clauses");

        return $due;
    }
}
