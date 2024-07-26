<?php

namespace App\Repositories;

use App\Models\TripExpense;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TripExpenseRepository extends BaseRepository
{
    public function model()
    {
        // todo: try TripExpense::class; and it return string and that i can use query
        return new TripExpense();
    }

    public function search(int $detailId, ?bool $withChildren = false, ?int $source = null, ?int $parentId = null, ?string $payDate = null): Collection
    {
        // todo: not working withoutEagerLoads, without, etc. ASK OPINION
        $tripExpenses = $withChildren ? $this->model()->with('children') : $this->model();
        $tripExpenses = $tripExpenses->where('trip_detail_id', $detailId);

        if ($source) {
            //
        }
        if ($parentId) {
            //
        }
        if ($payDate) {
            //
        }

        return $tripExpenses->orderBy('pay_date','desc')->get();
    }
    
}