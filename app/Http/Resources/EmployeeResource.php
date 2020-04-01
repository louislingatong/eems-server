<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'id_number' => $this->id_number,
            'employment_type' => $this->employment_type,
            'employment_status' => $this->employment_status,
            'employment_date' => $this->employment_date ? date('Y-m-d H:i:s', strtotime($this->employment_date)) : null,
            'regularization_date' => $this->regularization_date ? date('Y-m-d H:i:s', strtotime($this->regularization_date)) : null,
            'position' => new PositionResource($this->position),
            'user' => new UserWithoutRolesResource($this->user),
        ];
    }
}
