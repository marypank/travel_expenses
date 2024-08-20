<?php

namespace App\Http\Services\Enum;

use App\Models\Enum\SourceExpenseEnum;

class SourceExpenseService extends BaseEnumService
{
    protected static function enumClass()
    {
        return SourceExpenseEnum::class;
    }

    public function getByValue(int $value): SourceExpenseEnum
    {
        return SourceExpenseEnum::tryFrom($value);
    }

    public function getDefault(): array
    {
        return $this->getById(SourceExpenseEnum::CASH->value);
    }
}