<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
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
            $this->setUpTripExpense($tripExpense, $dto->getWithChildren());
        });

        return $tripExpenses->filter(fn(TripExpense $val) => is_null($val->parent_id));
    }

    public function modfifyForShow(TripExpense $tripExpense, bool $withChildren): TripExpense
    {
        $this->setUpTripExpense($tripExpense, $withChildren);

        if ($withChildren) {
            $tripExpense->children->each(function (TripExpense $te) use ($withChildren) {
                $this->setUpTripExpense($te, $withChildren);
            });
        }

        return $tripExpense;
    }

    private function setUpTripExpense(TripExpense $tripExpense, bool $withChildren): void
    {
        $valute = $this->currencyService->getById($tripExpense->currency_id);
        
        $tripExpense->currency = ExpenseCurrency::getCurrent($valute, $tripExpense->current_currency_exchange, $tripExpense->price);

        $tripExpense->withChildren = $withChildren;
        
        $tripExpense->sourceType = $this->sourceExpenseService->getById($tripExpense->source->value)['rusName'];
    }

}