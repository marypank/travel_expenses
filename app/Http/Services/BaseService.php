<?php

namespace App\Http\Services;

use App\Models\Dto\Base\BaseDtoInterface;
use App\Repositories\BaseRepository;
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
    public function create($dto): Model
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

    // todo: remove at the end
    /**
     * @param int $id
     * @param BaseDtoInterface $dto
     * @return Model
     */
    public function update(int $id, $dto): Model
    {
        return $this->mainRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $this->mainRepository->delete($id);
    }
}