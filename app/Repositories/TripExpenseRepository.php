<?php

namespace App\Repositories;

use App\Models\TripExpense;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        return new TripExpense();
    }

    // todo: не тут должно быть
    public function searchByUser(int $userId , ?int $status, ?string $dateFrom, ?string $dateTo): Collection
    {
        return new Collection();
    }

    // todo: не тут должно быть
    public function searchByTrip(int $userId , ?int $status, ?string $dateFrom, ?string $dateTo): Collection
    {
        return new Collection();
    }

    public function searchByDetails(int $detailId): Collection
    {
        $tripExpenses = TripExpense::where('trip_detail_id', $detailId);

        return $tripExpenses->orderBy('created_at','desc')->get();
    }
    
}