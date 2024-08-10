<?php

namespace App\Repositories;

use App\Http\Services\Base\SearchInterface;
use Illuminate\Database\Eloquent\Model;

interface DefaultRepositoryInterface extends SearchInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

}
