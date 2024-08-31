<?php

namespace App\Http\Actions\Trip;

use App\Http\Actions\BaseTagAction;

class TripTagAction extends BaseTagAction
{
    protected function deleteAction()
    {
        return new DeleteTagFromTripAction();
    }

    protected function addAction()
    {
        return new AddTagToTripAction();
    }
}