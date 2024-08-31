<?php

namespace App\Http\Actions;

use App\Repositories\BaseRepository;

abstract class BaseTagAction
{
    public const DELETE = 'delete';

    public const ADD = 'add';

    abstract protected function deleteAction();

    abstract protected function addAction();

    public function handle(int $id, int $tagId, string $operation)
    {
        if (!in_array($operation, [self::ADD, self::DELETE])) {
            return;
        }

        $instns = $operation === self::ADD ? $this->addAction() : $this->deleteAction();
        $instns->handle($id, $tagId, null);
    }
}