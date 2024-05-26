<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements DefaultRepositoryInterface
{
    /* public function all(array $params = []): Collection
    {
        // todo: Почему тут ошибка, если у Lanuage, например, нет ошибки в этом случае
        return $this->model()::all();
    } */

    protected abstract function model();

    public function findById(int|string $id): Model
    {
        return $this->model()::find($id);
    }

    public function create(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function delete(int|string $id): void
    {
        $this->model()::where('id', $id)
            ->delete();
    }

    public function update(int|string $id, array $data)
    {
        return tap($this->model()::find($id))->update($data)->fresh();
    }
}