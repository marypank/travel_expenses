<?php

namespace App\Http\Actions\TripDetail;
use App\Http\Actions\BaseTagActionInterface;
use App\Repositories\TripDetailRepository;

class DeleteTagFromTripActionDetail implements BaseTagActionInterface
{
    public function handle(int $id, int $tagId, ?string $operation)
    {
        $tripRepo = new TripDetailRepository();
        $trip = $tripRepo->getById($id);

        $trip->tags()->detach($tagId);
    }
}