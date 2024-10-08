<?php

namespace App\Http\Actions\TripDetail;

use App\Http\Actions\BaseTagAction;

class TripDetailTagAction extends BaseTagAction
{
    protected function deleteAction()
    {
        return new DeleteTagFromTripDetailAction();
    }

    protected function addAction()
    {
        return new AddTagToTripDetailAction();
    }
}