<?php

namespace App\Repositories;

use App\Models\Trip;

class TripRepository extends BaseRepository
{
    public function model()
    {
        return Trip::class;
    }

    public function getBySlug(string $slug): ?Trip
    {
        return $this->model()::where('slug', $slug)->first();
    }
}