<?php

namespace App\Repositories;

use App\Models\TripExpense;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        return new TripExpense();
    }
}