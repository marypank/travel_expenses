<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface DefaultServiceInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function create(BaseDto $dto): Model;

    public function update(BaseDto $dto): Model;

    public function delete(int $id): void;
}