<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'userId' => $this->user_id,
            'tripId' => $this->trip_id,
            'country' => [
                'id' => $this->country_id,
                'name' => '',
                'city' => [
                    'id' => $this->city_id,
                    'name' => '',
                ],
            ],
            // 'slug' => $this->slug,
            'dateFrom' => $this->date_from,
            'dateTo' => $this->date_to,
            'status' => $this->status,
        ];
    }
}
