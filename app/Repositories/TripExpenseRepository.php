<?php

namespace App\Repositories;

use App\Models\TripExpense;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        // todo: try TripExpense::class; and it return string and that i can use query
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