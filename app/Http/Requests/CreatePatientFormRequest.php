<?php

namespace App\Http\Requests;

use App\Http\Requests\API\FormRequest;

class CreatePatientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nin' => 'required',
            'first_name' => 'required',
            'middle_name' => '',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'residence' => 'required',
            'phone_number' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'health_facility_id' => ''
        ];
    }
}
