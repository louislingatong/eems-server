<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'particulars' => $this->particulars,
            'amount' => $this->amount,
            'issue_date' => date('Y-m-d H:i:s', strtotime($this->issue_date))
        ];
    }
}
