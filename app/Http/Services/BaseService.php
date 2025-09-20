<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDto;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseService implements BaseServiceInterface
{
    // todo: возможно сделать так, чтобы ответ из репозитория автоматически переводился в дто, чтобы было проще работать с объектом
    public function __construct(public BaseRepository $mainRepository)
    {}

    /**
     * @param int $id
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->mainRepository->all();
    }

    public function getById(int $id): ?Model
    {
        return $this->mainRepository->getById($id);
    }

    public function create(BaseDto $dto): Model
    {
        return $this->mainRepository->create($dto->toArray());
    }

    public function update(Model $model, BaseDto $dto): Model
    {
        return $this->mainRepository->update($model->id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $this->mainRepository->delete($id);
    }
}