<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;

class TripRepository extends BaseRepository
{
    public function model()
    {
        return new Trip();
    }
}