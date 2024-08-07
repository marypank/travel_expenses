<?php

namespace App\Http\Services;

use App\Http\Services\Base\CrudInterface;
use App\Http\Services\Base\SearchInterface;

interface DefaultServiceInterface extends CrudInterface, SearchInterface
{
    // todo: combine with repointerface
    // todo: remake what return create and update methods???
    
    // todo: prolly remove
    /* public function findById(int $id): ?Model;

    public function create(BaseDtoInterface $dto): void;

    public function delete(int $id): void;

    public function update(BaseDtoInterface $dto): ?Model; */
}