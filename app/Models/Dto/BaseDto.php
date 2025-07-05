<?php

namespace App\Models\Dto;

abstract class BaseDto implements BaseDtoInterface
{
    protected abstract function defineFields(): array;
    
    protected function removeEmptyValues(array $data): array
    {
        return array_filter($data, fn($value) => !is_null($value) && $value !== '');
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}