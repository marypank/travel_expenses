<?php

namespace App\Http\Actions\TripExpense;

use App\Http\Actions\BaseAddTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripExpenseRepository;

class AddTagToTripExpenseAction extends BaseAddTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripExpenseRepository();
    }
}