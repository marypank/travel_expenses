<?php

namespace App\Http\Services;

use App\Models\Dto\Trip\SearchTripDto;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Dto\Base\BaseDtoInterface;
use App\Models\Enum\TripStatusEnum;

class TripService extends BaseService
{
    public function __construct(TripRepository $tripRepository)
    {
        parent::__construct($tripRepository);
    }

    public function create(BaseDtoInterface $dto): void
    {
        // todo: проверки
        $dto->setStatus(TripStatusEnum::AWAIT->value);
        
        try {
            $model = $this->mainRepository->create($dto->toArray());

            if (!$model) {
                throw new \Exception("not created");
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function findBySlug(string $slug): ?Trip
    {
        $trip = $this->mainRepository->findBySlug($slug);

        if (!$trip) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }

    public function search(SearchTripDto $dto): Collection
    {
        $dto->setUserId(auth()->user()->id);

        return $this->mainRepository->search($dto->getUserId(), $dto->getStatus(), $dto->getDateFrom(), $dto->getDateTo());
    }

}