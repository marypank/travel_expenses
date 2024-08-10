<?php

namespace App\Http\Services;

use App\Http\Services\Base\SearchInterface;
use App\Models\Dto\Base\BaseDtoInterface;
use Illuminate\Database\Eloquent\Model;

interface DefaultServiceInterface extends SearchInterface
{
    public function create(BaseDtoInterface $dto): Model;

    public function update(Model $model, BaseDtoInterface $dto): Model;

    public function delete(int $id): void;
}