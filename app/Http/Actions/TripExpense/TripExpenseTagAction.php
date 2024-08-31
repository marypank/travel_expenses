<?php

namespace App\Http\Actions\TripExpense;

use App\Http\Actions\BaseTagAction;

class TripExpenseTagAction extends BaseTagAction
{
    protected function deleteAction()
    {
        return new DeleteTagFromTripExpenseAction();
    }

    protected function addAction()
    {
        return new AddTagToTripExpenseAction();
    }
}