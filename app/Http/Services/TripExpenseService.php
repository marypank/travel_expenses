<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDto;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TripExpenseService extends BaseService
{
    public function __construct(public TripExpenseRepository $tripExpenseRepository)
    {
        parent::__construct($tripExpenseRepository);
    }

    public function all(?int $tripId = null): Collection
    {
        return $this->tripExpenseRepository->all($tripId);
    }

    public function create(BaseDto $dto): Model
    {
        if ($dto->getImageFile())
        {
            // todo: переделать на хранение в папках для каждого пользователя
            $path = $dto->getImageFile()->storeAs('images', $dto->getImageFile()->getClientOriginalName(), 'public');
            $dto->setImageUrl($path);
        }

        return $this->mainRepository->create($dto->toArray());
    }

    public function update(Model $tripExpense, BaseDto $dto): Model
    {
        // todo: сделать удаление файла. возможно какой-то флаг, чтобы понять, что картинку налдо удалить
        if ($dto->getImageFile())
        {
            // todo: переделать на хранение в папках для каждого пользователя
            $path = $dto->getImageFile()->storeAs('images', $dto->getImageFile()->getClientOriginalName(), 'public');
            $dto->setImageUrl($path);
        }

        return $this->mainRepository->update($tripExpense->id, $dto->toArray());
    }
}