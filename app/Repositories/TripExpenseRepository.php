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

    /**
     * @param array $data
     * @return Collection
     */
    public function search($data): Collection
    {
        return new Collection();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function all(int $id): Collection
    {
        $expenses = $this->model()
            ->where('trip_detail_id', $id)
            ->orderBy('pay_date')
            ->get();

        return $expenses;
    }
    
}