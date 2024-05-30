<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface DefaultRepositoryInterface
{
    // public function all(array $params = []): Collection;
    public function findById(int|string $id): ?Model;

    public function create(array $data): Model;

    public function delete(int|string $id): void;

    public function update(int|string $id, array $data);

}
