<?php

namespace App\Repositories;

use App\Models\TripDetail;

class TripDetailRepository extends BaseRepository
{
    public function model()
    {
        return new TripDetail();
    }
}