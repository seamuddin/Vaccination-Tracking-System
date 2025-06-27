<?php

namespace App\Modules\Child\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChildRequest extends FormRequest
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
         $childId = $this->input('id');  // assuming route parameter is {child}

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('children')
                    ->where(function ($query) {
                        return $query->where('parent_id', $this->input('parent_id'));
                    })
                    ->ignore($childId),
            ],
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'parent_id' => 'required|exists:users,id',
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
            'name.required' => 'The child name is required',
            'name.unique' => 'This child name already exists for the selected parent.',
            'date_of_birth.required' => 'Date of birth is required',
            'date_of_birth.date' => 'Date of birth must be a valid date',
            'gender.required' => 'Gender is required',
            'gender.in' => 'Gender must be male, female, or other',
            'parent_id.required' => 'Parent information is required',
            'parent_id.exists' => 'Selected parent does not exist',
            // 'birth_certificate_no.unique' => 'This birth certificate number is already registered',
            // 'image.image' => 'The file must be an image',
            // 'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            // 'image.max' => 'The image may not be greater than 2MB',
            // 'weight.numeric' => 'Weight must be a number',
            // 'weight.min' => 'Weight cannot be negative',
            // 'height.numeric' => 'Height must be a number',
            // 'height.min' => 'Height cannot be negative',
        ];
    }
}
