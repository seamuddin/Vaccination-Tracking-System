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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The center name is required.',
            'address.required' => 'The address is required.',
            'email.email' => 'Please provide a valid email address.',
            'latitude.numeric' => 'Latitude must be a valid number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.numeric' => 'Longitude must be a valid number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
            'is_active.boolean' => 'Active status must be true or false.',
        ];
    }
}