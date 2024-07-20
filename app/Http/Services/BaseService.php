<?php

namespace App\Http\Services;

use App\Models\Dto\BaseDtoInterface;
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

    public function create(BaseDtoInterface $dto): void
    {
        // todo: dont like that dates go in strings not like dates
        // todo: custom Exception
        // todo: toArray and checkes

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
        $model = $this->mainRepository->findById($id);

        if (!$model) {
            throw new NotFoundHttpException("RecordNotFound"); // todo: refactor later
        }

        return $model;
    }

    public function delete(int|string $id): void
    {
        $this->mainRepository->delete($id);
    }

    public function update(BaseDtoInterface $dto): Model
    {
        // todo: toArray and checkes

        return $this->mainRepository->update($dto->getId(), $dto->toArray());
    }
}