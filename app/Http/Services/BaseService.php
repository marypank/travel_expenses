<?php

namespace App\Http\Services;

use App\Models\Dto\Base\BaseDtoInterface;
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

    /**
     * @param BaseDtoInterface $dto
     * @throws \Exception
     * @return Model
     */
    public function create(BaseDtoInterface $dto): Model
    {
        // todo: dont like that dates go in strings not like dates
        // todo: custom Exception
        // todo: toArray and checkes

        try {
            $model = $this->mainRepository->create($dto->toArray());

            if (!$model) {
                throw new \Exception("not created");
            }

            return $model;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function getById(int $id): ?Model
    {
        $model = $this->mainRepository->getById($id);

        if (!$model) {
            throw new NotFoundHttpException("RecordNotFound"); // todo: refactor later
        }

        return $model;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function all(int $id): Collection
    {
        return $this->mainRepository->all($id);
    }

    /**
     * @param Model $model
     * @param BaseDtoInterface $dto
     * @return Model
     */
    public function update(Model $model, BaseDtoInterface $dto): Model
    {
        return $this->mainRepository->update($model->id, $dto->toArray());
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->mainRepository->delete($id);
    }
}