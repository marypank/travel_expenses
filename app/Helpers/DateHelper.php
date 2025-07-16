<?php

namespace App\Helpers;

use Carbon\Carbon;

// todo: посмотреть лучше ли изменить на трейт
class DateHelper
{
    public static function toCarbonDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}