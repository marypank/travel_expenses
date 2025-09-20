<?php

namespace App\Models\Dto;

interface BaseDtoInterface
{
    public function toArray(bool $withEmptyValues = false): array;
}