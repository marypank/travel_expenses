<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
use App\Models\Enum\SourceExpenseEnum;
use App\Models\TripExpense;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseService extends BaseService
{

    public function __construct(
        TripExpenseRepository $tripDetailRepository,
        private CurrencyService $currencyService,
        private SourceExpenseService $sourceExpenseService
    )
    {
        parent::__construct($tripDetailRepository);
    }

    public function search(SearchTripExpenseDto $dto): Collection
    {
        $tripExpenses = $this->mainRepository->search($dto->getTripDetailId(), $dto->getWithChildren());

        $tripExpenses = $tripExpenses->each(function (TripExpense $tripExpense) use ($dto) {
            $valute = $this->currencyService->getById($tripExpense->currency_id);

            $tripExpense->currency = ExpenseCurrency::getCurrent($valute, $tripExpense->current_currency_exchange, $tripExpense->price);

            $tripExpense->withChildren = $dto->getWithChildren();

            $tripExpense->sourceType = $this->sourceExpenseService->getById($tripExpense->source->value)['rusName']
                ?? $this->sourceExpenseService->getDefault()['rusName'];
        });

        return $tripExpenses->filter(fn(TripExpense $val) => is_null($val->parent_id));
    }

}