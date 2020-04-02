<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|validEnum',
            'marital_status' => 'required|validEnum',
            'id_number' => 'required',
            'employment_type' => 'required|validEnum',
            'employment_status' => 'required|validEnum',
            'employment_date' => 'required|date_format:Y-m-d H:i:s',
            'regularization_date' => 'date_format:Y-m-d H:i:s',
            'position_id' => 'required|exists:positions,id',
        ];
    }
}
