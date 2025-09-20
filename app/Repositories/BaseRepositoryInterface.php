<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return void
     */
    public function getById(int $id): ?Model;

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}