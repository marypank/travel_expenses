<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements DefaultRepositoryInterface
{
    protected abstract function model();

    /**
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        return $this->model()::find($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create($data): Model
    {
        if (!$data) {
            return $this->model();
        }

        return $this->model()::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, $data): Model
    {
        if (!$data) {
            return $this->model();
        }

        return tap($this->model()::find($id))->update($data)->fresh();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model()::where('id', $id)
            ->delete();
    }
}