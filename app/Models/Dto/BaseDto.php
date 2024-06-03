<?php

namespace App\Models\Dto;

abstract class BaseDto implements BaseDtoInterface
{
    protected function removeEmptyValues(array $data): array
    {
        return array_filter($data, fn($value) => !is_null($value) && $value !== '');
    }
}