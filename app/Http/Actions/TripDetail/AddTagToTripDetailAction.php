<?php

namespace App\Http\Actions\TripDetail;

use App\Http\Actions\BaseAddTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripDetailRepository;

class AddTagToTripDetailAction extends BaseAddTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripDetailRepository();
    }
}