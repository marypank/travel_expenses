<?php

namespace App\Http\Actions;

interface BaseTagActionInterface
{
    public const DELETE = 'delete';

    public const ADD = 'add';

    public const MAX_RECORDS_FOR_EXPENSES = 2;

    public const MAX_RECORDS_FOR_OTHERS = 3;

    public function handle(int $id, int $tagId, ?string $operation);
}