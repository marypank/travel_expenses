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

    public function search(int $detailId, ?int $source = null, ?int $parentId = null, ?string $payDate = null): Collection
    {
        $tripExpenses = TripExpense::with('children')->where('trip_detail_id', $detailId);

        if ($source) {
            //
        }
        if ($parentId) {
            //
        }
        if ($payDate) {
            //
        }

        return $tripExpenses->orderBy('created_at','desc')->get();
    }
    
}