<?php

namespace App\Http\Actions\Trip;

use App\Http\Actions\BaseAddTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripRepository;

class AddTagToTripAction extends BaseAddTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripRepository();
    }
}