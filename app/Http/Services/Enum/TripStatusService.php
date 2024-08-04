<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\TripStatusEnum;

class TripStatusService
{
    /* protected static function enumClass()
    {
        return TripStatusEnum::class;
    }

    public function getDefault(): array
    {
        return [];
    } */

    public function getByValue(int $value): TripStatusEnum
    {
        return TripStatusEnum::tryFrom($value);
    }

    public function getDefault(): TripStatusEnum
    {
        return TripStatusEnum::AWAIT;
    }
}