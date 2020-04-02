<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LiquidationWithoutEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_amount' => $this->expenses->sum('amount'),
            'preparer' => new UserWithoutRolesResource($this->owner),
            'expenses' => ExpenseResource::collection($this->expenses),
        ];
    }
}
