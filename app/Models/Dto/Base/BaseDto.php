<?php

namespace App\Models\Dto\Base;

abstract class BaseDto implements BaseDtoInterface
{
    // todo: defineFields here rewrite
    
    protected function removeEmptyValues(array $data): array
    {
        return array_filter($data, fn($value) => !is_null($value) && $value !== '');
    }
}