<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseServiceInterface
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
     * @param BaseDto $dto
     * @return void
     */
    public function create(BaseDto $dto): Model;

    /**
     * @param Model $model
     * @param BaseDto $dto
     * @return void
     */
    public function update(Model $model, BaseDto $dto): Model;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}