<?php

namespace App\Models\Enum;

enum TripStatusEnum: int
{
    case INIT = 0;

    case IN_PROGRESS = 1;

    case TRASH = 2;

    case CANCEL = 3;

    case ARCHIVE = 4; // todo: ???
}