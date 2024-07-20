<?php

namespace App\Repositories;

use App\Models\TripDetail;

class TripDetailRepository extends BaseRepository
{
    public function model()
    {
        return new TripDetail();
    }

    public function search(
        int $tripId,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $status = null,
        ?int $countryId = null,
        ?int $cityId = null)
    {
        $details = TripDetail::where('trip_id', $tripId);

        if ($status) {
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
        }

        $details = $details->withCount('expenses');

        return $details->orderBy('date_from', 'desc')->get();
    }
}