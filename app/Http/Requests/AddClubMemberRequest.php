<?php

namespace App\Http\Requests;

use App\Rules\UniqueMemberRule;
use Illuminate\Foundation\Http\FormRequest;

class AddClubMemberRequest extends FormRequest
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
            'employee_ids.*' => ['required', 'distinct', 'exists:employees,id', 'uniqueMember'],
        ];
    }
}
