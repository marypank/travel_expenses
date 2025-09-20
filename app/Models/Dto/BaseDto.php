<?php

namespace App\Models\Dto;

abstract class BaseDto implements BaseDtoInterface
{
    /**
     * @return array
     */
    protected abstract function defineFields(): array;
    
    /**
     * @param array $data
     * @return array
     */
    protected function removeEmptyValues(array $data): array
    {
        return array_filter($data, fn($value) => !is_null($value) && $value !== '');
    }

    /**
     * @param bool $withEmptyValues
     * @return array
     */
    public function toArray(bool $withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}