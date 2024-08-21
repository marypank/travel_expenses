<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\SourceExpenseEnum;

class SourceExpenseService extends BaseEnumService
{
    protected static function enumClass()
    {
        return SourceExpenseEnum::class;
    }

    // todo: переписать getById на getByValue, заменить вызовы getById на getByValue
    public function getByValue(int $value): SourceExpenseEnum
    {
        return SourceExpenseEnum::tryFrom($value);
    }

    public function getDefault(): SourceExpenseEnum
    {
        return SourceExpenseEnum::CASH;
    }
}