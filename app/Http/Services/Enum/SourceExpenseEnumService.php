<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\SourceExpenseEnum;

class SourceExpenseEnumService extends BaseEnumService
{
    protected static function enumClass()
    {
        return SourceExpenseEnum::class;
    }
    
    public function getDefault(): SourceExpenseEnum
    {
        return SourceExpenseEnum::CASH;
    }
}