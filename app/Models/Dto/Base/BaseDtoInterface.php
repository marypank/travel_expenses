<?php

namespace App\Models\Dto\Base;

interface BaseDtoInterface
{
    public function toArray($withEmptyValues = false): array;
}