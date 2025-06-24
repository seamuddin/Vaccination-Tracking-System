<?php

namespace App\Modules\Vaccine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccineRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'doses_required' => 'required|integer|min:1',
            'interval_days' => 'nullable|integer|min:0',
            // 'code' => 'nullable|string|max:50|unique:vaccines,code',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The vaccine name is required',
            'manufacturer.required' => 'Manufacturer is required',
            'doses_required.required' => 'Number of doses is required',
            'doses_required.integer' => 'Doses required must be an integer',
            'doses_required.min' => 'Doses required must be at least 1',
            'interval_days.integer' => 'Interval days must be an integer',
            'interval_days.min' => 'Interval days cannot be negative',
            // 'code.unique' => 'This vaccine code is already registered',
            // 'image.image' => 'The file must be an image',
            // 'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            // 'image.max' => 'The image may not be greater than 2MB',
        ];
    }
}
