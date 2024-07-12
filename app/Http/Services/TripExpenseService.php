<?php

namespace App\Http\Services;

use App\Models\TripDetail;
use App\Repositories\TripExpenseRepository;
use Illuminate\Database\Eloquent\Collection;

class TripExpenseService extends BaseService
{
    public function __construct(TripExpenseRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
    }

    public function search(array $params): Collection
    {
        if (!isset($params['userId']) && !isset($params['tripDetailId']) && !isset($params['tripId'])) {
            throw new \Exception('params required'); // todo: remake
        }

        // todo: убрать это
        if (isset($params['tripDetailId'])) {
            return $this->mainRepository->searchByDetails($params['tripDetailId']);
        } else if (isset($params['userId'])) {
            //
        } else if (isset($params['tripId'])) {
            //
        } else {

        }

        return new Collection();
    }

}