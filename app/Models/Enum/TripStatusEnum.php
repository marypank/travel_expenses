<?php

namespace App\Models\Enum;

enum TripStatusEnum: int
{
    case AWAIT = 0;

    case IN_PROGRESS = 1;

    case FINISHED = 2;

    case CANCELED = 3;
}