<?php

namespace App\Http\Services;

use App\Models\Dto\TripExpense\SearchTripExpenseDto;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseService extends BaseService
{
    public function __construct(TripExpenseRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
    }

    public function search(SearchTripExpenseDto $dto): Collection
    {
        $tripExpenses = $this->mainRepository->search($dto->getTripDetailId());

        return $tripExpenses->filter(fn($val, $key) => is_null($val->parent_id));
    }

}