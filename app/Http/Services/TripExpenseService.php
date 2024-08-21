<?php

namespace App\Http\Services;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\AdditionalModel\ExpenseCurrency;
use App\Models\Dto\Base\BaseDtoInterface;
use App\Models\Dto\TripExpense\UpdateTripExpenseDto;
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

    /**
     * @param array $data
     * @return Collection
     */
    public function search($data): Collection
    {
        $withChildren = $data['withChildren'] ?? false;

        $expenses = $this->mainRepository->all($data['tripDetailId']);

        $expenses->each(function ($item) use($withChildren) {
            $this->modfifyForShow($item, $withChildren);
        });

        return $expenses;
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

        if ($dto->getSource() && $parent && $dto->getSource()->value !== $parent->source->value) {
            throw new \Exception('child source doesnt match parent source'); // todo: custom
        }

        return $this->mainRepository->update($dto->getId(), $dto->toArray());
    }

}