<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
use App\Models\TripExpense;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseService extends BaseService
{
    private CurrencyService $currencyService;

    public function __construct(TripExpenseRepository $tripDetailRepository, CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
        parent::__construct($tripDetailRepository);
    }

    public function search(SearchTripExpenseDto $dto): Collection
    {
        $tripExpenses = $this->mainRepository->search($dto->getTripDetailId(), $dto->getWithChildren());

        $tripExpenses = $tripExpenses->each(function (TripExpense $tripExpense, int $key) {
            $valute = $this->currencyService->getById($tripExpense->currency_id);

            $tripExpense->currency = ExpenseCurrency::getCurrent($valute, $tripExpense->current_currency_exchange, $tripExpense->price);

            // todo: count all if children exists
            // todo: не работает нифига загрузка без релейшнв
            // $tripExpense->unsetRelation('children');
            // var_dump($tripExpense->children->count());
            // var_dump($tripExpense);
        });

        $res = $tripExpenses->filter(fn(TripExpense $val) => is_null($val->parent_id));

        $res = $res->each(function (TripExpense $tripExpense, int $key) {
            // var_dump($tripExpense->children);
        });
        // var_dump($res->count());
        // exit();

        return $res;
    }

}