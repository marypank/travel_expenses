<?php

namespace App\Http\Actions\TripExpense;

use App\Http\Actions\BaseDeleteTagAction;
use App\Repositories\BaseRepository;
use App\Repositories\TripExpenseRepository;

class DeleteTagFromTripExpenseAction extends BaseDeleteTagAction
{
    protected function getRepository(): BaseRepository
    {
        return new TripExpenseRepository();
    }
}