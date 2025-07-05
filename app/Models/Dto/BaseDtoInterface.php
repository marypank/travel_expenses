<?php

namespace App\Models\Dto;

interface BaseDtoInterface
{
    public function toArray($withEmptyValues = false): array;
}