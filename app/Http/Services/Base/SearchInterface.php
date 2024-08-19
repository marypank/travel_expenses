<?php

namespace App\Http\Services\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SearchInterface
{
    /**
     * @param mixed $params
     * @return Collection
     */
    public function search($params): Collection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model;

    /**
     * @param int $id
     * @return Collection
     */
    public function all(int $id): Collection;
}