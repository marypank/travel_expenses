<?php

namespace App\Http\Actions\Trip;

use App\Http\Actions\BaseTagActionInterface;
use App\Repositories\TripRepository;

class DeleteTagFromTripAction implements BaseTagActionInterface
{
    public function handle(int $id, int $tagId, ?string $operation)
    {
        $tripRepo = new TripRepository();
        $trip = $tripRepo->getById($id);

        $trip->tags()->detach($tagId);
    }
}