<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\SourceExpenseEnum;

class SourceExpenseService extends BaseEnumService
{
    protected static function enumClass()
    {
        return SourceExpenseEnum::class;
    }

}