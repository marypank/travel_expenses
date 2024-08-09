<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'userId' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'tripsCount' => count($this->details),
            'dateFrom' => $this->date_from,
            'dateTo' => $this->date_to,
            'status' => $this->status,
            // 'created' => $this->created_at,
            // 'updated' => $this->updated_at,
        ];
    }
}
