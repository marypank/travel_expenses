<?php

namespace App\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

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

    /* public function searchByParams(): Collection
    {
        return new Collection();
    } */

    public function searchByUser(int $userId , ?int $status, ?string $dateFrom, ?string $dateTo): Collection
    {
        $trip = Trip::where('user_id', $userId);

        if ($status) {
            $trip = $trip->where('status', $status);
        }
        if ($dateFrom) {
            $trip = $trip->where('date_from', '>=', $dateFrom);
        }
        if ($dateTo) {
            $trip = $trip->where('date_to', '<=', $dateTo);
        }
        
        return $trip->orderBy('date_from','desc')->get();
    }
}