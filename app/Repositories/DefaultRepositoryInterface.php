<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface DefaultRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function create(): Model;

    public function update(): Model;

    public function delete(int $id): void;
}