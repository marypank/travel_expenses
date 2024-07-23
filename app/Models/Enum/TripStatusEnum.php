<?php

namespace App\Models\Enum;

enum TripStatusEnum: int
{
    case AWAIT = 0;

    case IN_PROGRESS = 1;

    case FINISHED = 2;

    case CANCEL = 3;

    // case ARCHIVE = 4;

    public const RUS_NAMES = [
        self::AWAIT->value => 'Новый',
        self::IN_PROGRESS->value => 'В процессе',
        self::FINISHED->value => 'Завершен',
        self::CANCEL->value => 'Отменен',
        // self::ARCHIVE->value => 'Архив',
    ];
}