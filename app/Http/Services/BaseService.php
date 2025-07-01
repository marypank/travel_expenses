<?php

namespace App\Http\Services;

use App\Repositories\BaseRepository;

abstract class BaseService implements DefaultServiceInterface
{
    public function __construct(protected BaseRepository $mainRepository)
    {}
}