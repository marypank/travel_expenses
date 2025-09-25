<?php

namespace App\Repositories;

use App\Models\TripExpense;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        return TripExpense::class;
    }

    public function all(?int $tripId = null): Collection
    {
        return $this->model()::where('trip_id', $tripId)->get();
    }
}