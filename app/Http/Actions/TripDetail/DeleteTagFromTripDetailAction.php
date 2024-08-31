<?php

namespace App\Http\Actions\TripDetail;

use App\Http\Actions\BaseDeleteTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripDetailRepository;

class DeleteTagFromTripDetailAction extends BaseDeleteTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripDetailRepository();
    }
}