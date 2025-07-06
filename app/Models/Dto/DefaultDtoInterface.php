<?php

namespace App\Models\Dto;

interface DefaultDtoInterface
{
    public function toArray(bool $withEmptyValues = false): array;
}