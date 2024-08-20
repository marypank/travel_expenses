<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\Base\BaseDtoInterface;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
use App\Models\Dto\TripExpense\TripExpenseDto;
use App\Models\Dto\TripExpense\UpdateTripExpenseDto;
use App\Models\Enum\SourceExpenseEnum;
use App\Models\TripExpense;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
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

    public function search($dto): Collection
    {
        return new Collection();
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

    // todo: update is not compatible, so rewtire (todo in notion about separation interfaces and base classes)
    // public function update(TripExpense $tripExpense, UpdateTripExpenseDto $dto): TripExpenseDto
    /**
     * @param TripExpense $tripExpense
     * @param UpdateTripExpenseDto $dto
     * @throws \Exception
     * @return TripExpense
     */
    public function update(Model $tripExpense, BaseDtoInterface $dto): Model
    {
        $parent = $tripExpense->parent;
        if ($dto->getParentId()) {
            $parent = $this->mainRepository->getById($dto->getParentId());
            
            if ($parent->trip_detail_id !== $tripExpense->trip_detail_id) {
                throw new \Exception('trip must be the same'); // todo: custom
            }
        }

        if (!is_null($dto->getSource()) && $parent && $dto->getSource() !== $parent->source->value) {
            throw new \Exception('child source doesnt match parent source'); // todo: custom
        }

        if ($dto->getPayDate() && $parent && $this->checkDateParentMismatch($dto->getPayDate(), $parent->pay_date)) {
            throw new \Exception('pay date should be like parent date'); // todo: custom
        }

        return $this->mainRepository->update($dto->getId(), $dto->toArray());
    }

    // todo: in source service
    private function checkSourceOrThrowError(int $source)
    {
        if (!in_array($source, array_column(SourceExpenseEnum::cases(), 'value'))) {
            // throw new \Exception('source not defined'); // todo: custom
        }
    }

    // todo: remove
    private function checkDateParentMismatch(string $date, Carbon $parentDate): bool
    {
        return Carbon::parse($date) > $parentDate || Carbon::parse($date) < $parentDate;
    }

}