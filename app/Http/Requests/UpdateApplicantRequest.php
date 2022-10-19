<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateApplicantRequest extends FormRequest
{
    /** 
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /* 
    public function authorize()
    {
        return false;
    }
    */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:applicant,email,' . request()->route()->parameters['id'],
            'position' => 'required',
            'birthPlace' => 'required',
            'birthDate' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'education' => 'required',
            'edufrom' => 'required',
            'eduto' => 'required',
            'workingexp' => 'required',
            'workfrom' => 'required',
            'workto' => 'required',
            'workingpos' => 'required',
            'workingdesc' => 'required',
            'capabilities' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
