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
            'tripId' => $this->trip_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'expensesCount' => $this->expenses_count,
            'dateFrom' => $this->date_from,
            'dateTo' => $this->date_to,
            'location' => [
                'countryId' => $this->country_id,
                'cityId' => $this->city_id,
            ],
        ];
    }
}
