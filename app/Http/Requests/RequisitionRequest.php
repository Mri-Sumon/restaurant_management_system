<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requisition.supplier_id' => 'required',
            'requisition.date' => 'required',
            'requisition.invoice' => 'required',
            'requisition.subtotal' => 'required',
            'requisition.total' => 'required',
            'carts' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'requisition.supplier_id.required' => 'Supplier name required',
            'requisition.date.required' => 'Requisition date required',
            'requisition.invoice.required' => 'Requisition invoice required',
            'requisition.subtotal.required' => 'Subtotal required',
            'requisition.total.required' => 'Total required',
            'carts.required' => 'Cart is empty',
        ];
    }
}
