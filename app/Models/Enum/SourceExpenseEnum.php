<?php

namespace App\Models\Enum;

enum SourceExpenseEnum: int
{
    case CARD = 0;
    case CASH = 1;

    public const RUS_NAMES = [
        self::CARD->value => 'Карта',
        self::CASH->value => 'Наличные',
    ];
}