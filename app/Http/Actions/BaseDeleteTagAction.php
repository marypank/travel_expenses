<?php

namespace App\Http\Actions;

use App\Repositories\BaseRepository;

abstract class BaseDeleteTagAction
{
    abstract protected function getRepository(): BaseRepository;

    public function handle(int $id, int $tagId)
    {
        $repo = $this->getRepository();
        $data = $repo->getById($id);

        $data->tags()->detach($tagId);
    }
}