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

    public function findBySlug(string $slug): ?Trip
    {
        return Trip::where('slug', $slug)->first();
    }
}