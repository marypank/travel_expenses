<?php

namespace App\Http\Services\Enum;

interface DefaultEnumServiceInterface
{
    public function all(): array;

    public function getById(int $id): array;
}