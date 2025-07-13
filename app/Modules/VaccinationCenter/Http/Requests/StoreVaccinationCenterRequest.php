<?php

namespace App\Modules\VaccinationCenter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccinationCenterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'google_place_id' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The center name is required.',
            'address.required' => 'The address is required.',
            'email.email' => 'Please provide a valid email address.',
            
            'is_active.boolean' => 'Active status must be true or false.',
        ];
    }
}