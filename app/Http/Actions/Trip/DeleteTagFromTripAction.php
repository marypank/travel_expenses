<?php

namespace App\Http\Actions\Trip;

use App\Http\Actions\BaseDeleteTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripRepository;

class DeleteTagFromTripAction extends BaseDeleteTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripRepository();
    }
}