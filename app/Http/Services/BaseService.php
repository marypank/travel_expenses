<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDtoInterface;
use App\Models\Enum\TripStatusEnum;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseService implements DefaultServiceInterface
{
    /** @var BaseRepository $mainRepository */
    protected $mainRepository;

    public function __construct(BaseRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function findAll(array $params = []): Collection
    {
        // todo: make
        return new Collection();
    }

    public function create(BaseDtoInterface $dto): void
    {
        // todo: dont like that dates go in strings not like dates
        // todo: custom Exception
        if (!$dto->getUserId()) { // todo: does everything has userId?
            // new Exception
        }

        try {
            $model = $this->mainRepository->create($dto->toArray());

            if (!$model) {
                throw new \Exception("not created");
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function findById(int $id): ?Model
    {
        // todo: а что насчет ебFнjй политики, которая не должна позволять найти не свой пост
        $model = $this->mainRepository->findById($id);

        if (!$model) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $model;
    }

    public function delete(int|string $id): void
    {
        $this->mainRepository->delete($id);
    }

    public function update(BaseDtoInterface $dto): Model
    {
        if (!$dto->getId()) {
            // new Exception
        }

        return $this->mainRepository->update($dto->getId(), $dto->toArray());
    }
}