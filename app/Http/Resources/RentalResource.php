<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'start_date'   => $this->date_depart,
            'end_date'     => $this->date_final,
            'total_price'  => $this->prix_total,
            'user_id'      => $this->user_id,
            'equipment_id' => $this->equipment_id
        ];
    }
}
