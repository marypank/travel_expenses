<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    // todo: другая директория
    // todo: кривое название метода
    public static function checkDateParentMismatch(Carbon $date, Carbon $parentDate): bool
    {
        return $date > $parentDate || $date < $parentDate;
    }

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

    public static function getDifferenceBetweenDays(Carbon $dateFrom, Carbon $dateTo): int
    {
        // todo: дни пофиксить. не включает 1 день как полный день (сделала пока +1), получается 0 (разница между датами)
        return (int)$dateFrom->diffInDays($dateTo) + 1;
    }

}