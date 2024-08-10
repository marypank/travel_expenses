<?php

namespace App\Http\Services\Base;

use Carbon\Carbon;

class DateHelper
{
    public static function checkDateParentMismatch(Carbon $date, Carbon $parentDate): bool
    {
        return $date > $parentDate || $date < $parentDate;
    }

    public static function toCarbonDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }

}