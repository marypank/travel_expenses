<?php

namespace App\Http\Services\Enum;

interface BaseEnumServiceInterface
{
    /**
     * @param bool $convertArray
     * @return void
     */
    public function all(bool $convertArray = false): array;

    /**
     * @param int $id
     * @param bool $convertArray
     * @return void
     */
    public function getByValue(int $id, bool $convertArray = false);

    /**
     * @param mixed $item
     * @return void
     */
    public function toArray($item): array;
}