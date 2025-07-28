<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements DefaultRepositoryInterface
{
    protected abstract function model();

    /**
     * // todo: удалить all, он не общий, сделать его абстрактным
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->model()::where('user_id', auth()->user()->id)->get();
    }

    /**
     * @param int $id
     */
    public function getById(int $id): ?Model
    {
        return $this->model()::find($id);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): Model
    {
        if (!$data) {
            return $this->model();
        }

        return $this->model()::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data): Model
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