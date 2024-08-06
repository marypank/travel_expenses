<?php

namespace App\Http\Services\Base;

use Illuminate\Database\Eloquent\Model;

interface CrudInterface
{
    /**
     * @param mixed $data
     * @return void
     */
    public function create($data): Model;

    /**
     * @param int $id
     * @param mixed $data
     * @return Model
     */
    public function update(int $id, $data): Model;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}