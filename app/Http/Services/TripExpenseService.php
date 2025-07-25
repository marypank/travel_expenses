<?php

namespace App\Http\Services;

use App\Repositories\TripExpenseRepository;
use Illuminate\Support\Collection;

class TripExpenseService extends BaseService
{
    public function __construct(public TripExpenseRepository $tripExpenseRepository)
    {
        parent::__construct($tripExpenseRepository);
    }

    public function all(?int $tripId = null): Collection
    {
        return $this->tripExpenseRepository->all($tripId);
    }
}