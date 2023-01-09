<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCakeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'max:255',
            'description' => 'max:255',
            'weight',
            'price',
            'available_quantity',
        ];
    }
}
