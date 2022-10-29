<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:coupons,code,'.$this->coupon,
            'condition' => 'required|numeric',
            'quantity' => 'required|numeric',
            'number' => 'required|numeric',
            'start_date' => 'required|date',
            'expery_date' => 'required|date'
        ];

    }
}
