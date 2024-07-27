<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
use App\Models\Dto\TripExpense\TripExpenseDto;
use App\Models\Dto\TripExpense\UpdateTripExpenseDto;
use App\Models\Enum\SourceExpenseEnum;
use App\Models\TripExpense;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    // Также если у parent трипа оплата наличкой, нельзя в дочернем указать картой
    // Дата может быть раньше, но не позже окончания трипа

    // todo: update is not compatible, so rewtire (todo in notion about separation interfaces and base classes)
    public function updateExpense(TripExpense $tripExpense, UpdateTripExpenseDto $dto): TripExpenseDto
    {
        // todo: проверить если есть pay date и родитель или новый родитель
        var_dump(214214);
        exit();
        // todo: проверка, что у этого parentId тот же tripDetailid, что и у этого
        // А еще чтобы дата родительского была равна измененной
        if ($dto->getParentId()) {
            $parent = $this->mainRepository->findById($dto->getParentId());

            // $parent->trip_detail_id
            

            // if ($dto->getPayDate()) {
                //
            //}
        }
        if ($dto->getPayDate()) {
            //
        }

        exit();
        // return $this->mainRepository->update($dto->getId(), $dto->toArray());
    }

    // todo: in source service
    private function checkSourceOrThrowError(int $source)
    {
        if (!in_array($source, array_column(SourceExpenseEnum::cases(), 'value'))) {
            throw new \Exception('source not defined'); // todo: custom
        }
    }

    private function checkDate()
    {
        //
    }

}