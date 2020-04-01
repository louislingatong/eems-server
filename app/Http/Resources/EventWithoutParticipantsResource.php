<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventWithoutParticipantsResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'schedules' => ScheduleResource::collection($this->schedules),
            'location' => $this->location,
            'event_status' => $this->event_status,
            'employee_event_id' => $this->pivot->id,
            'employee_event_response' => $this->pivot->event_response,
        ];
    }
}
