<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tripId' => $this->trip_id,
            'title' => $this->title,
            'description' => $this->description,
            'payDate' => $this->pay_date,
            'price' => $this->price,
            'currencyId' => $this->currency_id,
            'currencyExchangeRate' => $this->currency_exchange_rate,
            'source' => $this->source,
        ];
    }
}
