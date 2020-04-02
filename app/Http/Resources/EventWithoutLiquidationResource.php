<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventWithoutLiquidationResource extends JsonResource
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
            'participants' => ParticipantResource::collection($this->participants),
            'event_status' => $this->event_status,
        ];
    }
}
