<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLiquidationRequest extends FormRequest
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
            'event_id' => 'required|exists:events,id',
            'expenses.*.particulars' => 'required',
            'expenses.*.amount' => 'required|numeric',
            'expenses.*.issue_date' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
