<?php

namespace App\Repositories;

use App\Http\Services\Base\CrudInterface;
use App\Http\Services\Base\SearchInterface;

interface DefaultRepositoryInterface extends SearchInterface, CrudInterface
{
    // todo: prolly remove
    /* public function search(array $params = []): Collection;

    public function update(int $id, array $data = []): Model; */

    /* public function search(array $params = null): Collection;

    public function getById(int $id = null): ?Model;

    public function create(array $data = null): Model;

    public function delete(int $id = null): void;

    public function update(int $id = null, array $data = null): Model; */  

}
