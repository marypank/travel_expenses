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

    public function search($data): Collection
    {
        // $details = $this->model()::where('trip_id', $tripId);

        /* if ($status) {
            $details = $details->where('status', $status);
        }
        if ($dateFrom) {
            $details = $details->where('date_from', '>=', $dateFrom);
        }
        if ($dateTo) {
            $details = $details->where('date_to', '<=', $dateTo);
        }
        if ($countryId) {
            $details = $details->where('country_id', $countryId);
        }
        if ($cityId) {
            $details = $details->where('city_id', $cityId);
        } */

        // $details = $details->withCount('expenses');

        // return $details->orderBy('date_from', 'desc')->get();
        return new Collection();
    }

    public function all(int $id): Collection
    {
        return new Collection();
    }
}