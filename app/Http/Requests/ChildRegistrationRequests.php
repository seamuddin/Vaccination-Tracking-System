<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChildRegistrationRequests extends FormRequest
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
        $childId = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('children', 'name')->where(function ($query) {
                    return $query->where('parent_id', auth()->id());
                })->ignore($this->input('id')),
            ],
            'dob' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female,other',
            'birth_certificate_no' => [
                'required',
                'integer',
                Rule::unique('children', 'birth_certificate_no')->ignore($childId)
            ],
            'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10048',
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
            'name.unique' => 'This child name already exists.',
            'dob.required' => 'Date of birth is required',
            'dob.date' => 'Date of birth must be a valid date',
            'dob.before_or_equal' => 'Date of birth cannot be in the future',
            'gender.required' => 'Gender is required',
            'gender.in' => 'Gender must be male, female, or other',
            'birth_certificate_no.required' => 'Birth certificate number is required',
            'birth_certificate_no.integer' => 'Birth certificate number must be an integer',
            'birth_certificate_no.unique' => 'This birth certificate number is already registered',
            'birth_certificate.required' => 'Birth certificate file is required',
            'birth_certificate.file' => 'Birth certificate must be a file',
            'birth_certificate.mimes' => 'Birth certificate must be a file of type: pdf, jpg, jpeg, png',
            'birth_certificate.max' => 'Birth certificate may not be greater than 10MB',
        ];
    }
}