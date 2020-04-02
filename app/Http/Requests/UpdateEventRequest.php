<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'name' => 'required',
            'schedules.*.date' => 'required|date_format:Y-m-d',
            'schedules.*.start_time' => 'date_format:H:i',
            'schedules.*.end_time' => 'date_format:H:i',
            'location' => 'required',
        ];
    }
}
