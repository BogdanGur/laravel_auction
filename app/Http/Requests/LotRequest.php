<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotRequest extends FormRequest
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
            'name_lot' => "required|min:3|max:255",
            'description' => "required|min:5",
            'start_price' => "required|numeric",
            'category' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png'
        ];
    }
}
