<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required|max:255|',
            'email' => 'required|max:255|email|',
            'address' => 'required|max:255|',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|max:10',
        ];
    }
}
