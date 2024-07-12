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
            'currencyId' => $this->currency_id, // todo: валюта название здесь долждно быть
            'current' => $this->current_currency_exchange,
            'source' => $this->source, // todo: string enum needed
            'title' => $this->title,
            'description' => $this->description,
            'parentId' => $this->parent_id,
            // 'parent' => new self($this->parent), // todo  read ECONNRESET

            'payDate' => $this->pay_date,
            'image' => $this->image,
            'price' => $this->price,
            // todo: if update children dont need
            'children' => self::collection($this->children),
        ];
    }
}
