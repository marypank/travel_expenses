<?php

namespace App\Http\Actions\TripDetail;
use App\Http\Actions\BaseTagActionInterface;
use App\Repositories\TripDetailRepository;

class AddTagToTripDetailAction implements BaseTagActionInterface
{
    public function handle(int $id, int $tagId, ?string $operation)
    {
        $tripRepo = new TripDetailRepository();
        $trip = $tripRepo->getById($id);

        if ($trip->tags()->count() >= self::MAX_RECORDS_FOR_OTHERS) {
            throw new \Exception("max tags to trip already added");
        }

        $trip->tags()->attach($tagId);
    }
}