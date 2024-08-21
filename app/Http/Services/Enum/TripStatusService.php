<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\TripStatusEnum;

class TripStatusService extends BaseEnumService
{
    protected static function enumClass()
    {
        return TripStatusEnum::class;
    }

    // todo: переписать getById на getByValue, заменить вызовы getById на getByValue
    public function getByValue(int $value): TripStatusEnum
    {
        return TripStatusEnum::tryFrom($value);
    }

    public function getDefault(): TripStatusEnum
    {
        return TripStatusEnum::AWAIT;
    }
}