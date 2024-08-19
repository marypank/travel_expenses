<?php

namespace App\Repositories;

use App\Models\Trip;
use App\Models\TripDetail;
use Illuminate\Database\Eloquent\Collection;

class TripDetailRepository extends BaseRepository
{
    public function model()
    {
        return new TripDetail();
    }

    /**
     * @param int $tripId
     * @return Trip
     */
    public function getParentTrip(int $tripId): Trip
    {
        return (new TripRepository())->getById($tripId);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($data): Collection
    {
        return new Collection();
    }

    /**
     * @param int $tripId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(int $tripId): Collection
    {
        // todo: maybe add user_id
        return $this->model()
            ->where('trip_id', $tripId)
            ->orderBy('date_from')
            ->get();
    }
}