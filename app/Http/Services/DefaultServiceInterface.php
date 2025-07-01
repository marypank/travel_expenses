<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface DefaultServiceInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function create(): Model;

    public function update(): Model;

    public function delete(int $id): void;
}