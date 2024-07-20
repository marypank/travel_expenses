<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDtoInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface DefaultServiceInterface
{
    // todo: combine with repointerface
    // todo: remake what return create and update methods???
    
    public function findById(int $id): ?Model;

    public function create(BaseDtoInterface $dto): void;

    public function delete(int $id): void;

    public function update(BaseDtoInterface $dto): ?Model;
}