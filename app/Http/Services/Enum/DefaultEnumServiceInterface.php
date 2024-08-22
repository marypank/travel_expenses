<?php

namespace App\Http\Services\Enum;

interface DefaultEnumServiceInterface
{
    public function all(bool $convertArray = false): array;

    public function getByValue(int $id, bool $convertArray = false);

    public function toArray($item): array;
}