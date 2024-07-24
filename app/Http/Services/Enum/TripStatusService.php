<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\TripStatusEnum;

class TripStatusService extends BaseEnumService
{
    protected static function enumClass()
    {
        return TripStatusEnum::class;
    }

    public function getDefault(): array
    {
        return [];
    }
}