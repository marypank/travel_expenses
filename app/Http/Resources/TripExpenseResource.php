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
            'currency' => $this->currency->toArrayForExpense(),
            'sourceType' => $this->sourceType,
            'title' => $this->title,
            'description' => $this->description,
            'parentId' => $this->parent_id,
            'payDate' => $this->pay_date,
            'childrenCount' => count($this->children),
            'children' => $this->withChildren ? self::collection($this->children) : null, // todo: не работает нифига загрузка без релейшнв
        ];
    }
}
