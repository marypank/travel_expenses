<?php

namespace App\Http\Services;

use App\Repositories\TripDetailRepository;

class TripDetailService extends BaseService
{
    public function __construct(TripDetailRepository $tripDetailRepository)
    {
        parent::__construct($$tripDetailRepository);
    }

}