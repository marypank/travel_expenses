<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripExpenseResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tripDetailId' => $this->trip_detail_id,
            // todo: 'currency' => $this->currency->toArray(),
            'source' => $this->source, // todo: string enum needed
            'title' => $this->title,
            'description' => $this->description,
            'parentId' => $this->parent_id,
            // 'parent' => new self($this->parent), // todo  read ECONNRESET
            'payDate' => $this->pay_date,
            'image' => $this->image,
            'children' => $this->children ? self::collection($this->children) : null,
        ];
    }
}
