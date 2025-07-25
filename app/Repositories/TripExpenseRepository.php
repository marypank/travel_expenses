<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\TripExpense;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        return new TripExpense();
    }

    public function all(?int $tripId = null): Collection
    {
        return $this->model()::where('trip_id', $tripId)->get();
    }
}