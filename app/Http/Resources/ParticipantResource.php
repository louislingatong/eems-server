<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
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
            'email' => $this->user->email,
            'event_response' => $this->pivot->event_response,
        ];
    }
}
