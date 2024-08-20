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

    public function search($data): Collection
    {
        return new Collection();
    }

    public function all(int $id): Collection
    {
        return new Collection();
    }
    
}