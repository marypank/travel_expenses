<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function toCarbonDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }

    public static function isChildDateLess(Carbon $date, Carbon $parentDate): bool
    {
        return $date < $parentDate;
    }

    public static function isChildDateGreater(Carbon $date, Carbon $parentDate): bool
    {
        return $date > $parentDate;
    }
}