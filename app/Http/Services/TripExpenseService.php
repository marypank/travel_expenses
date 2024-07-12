<?php

namespace App\Http\Services;

use App\Repositories\TripExpenseRepository;

class TripExpenseService extends BaseService
{
    public function __construct(TripExpenseRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
    }

}