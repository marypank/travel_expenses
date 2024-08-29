<?php

namespace App\Http\Actions;

interface BaseTagActionInterface
{
    public const DELETE = 'delete';

    public const ADD = 'add';

    public function handle(int $id, int $tagId, string $operation);
}