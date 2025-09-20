<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\TripStatusEnum;

class TripStatusEnumService extends BaseEnumService
{
    protected static function enumClass()
    {
        return TripStatusEnum::class;
    }

    public function getDefault()
    {
        return TripStatusEnum::AWAIT;
    }
}