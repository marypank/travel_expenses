<?php

namespace App\Http\Actions\TripDetail;
use App\Http\Actions\BaseTagActionInterface;

class TripDetailTagAction implements BaseTagActionInterface
{
    public function handle(int $id, int $tagId, ?string $operation)
    {
        if (!in_array($operation, [self::ADD, self::DELETE])) {
            return;
        }

        $instns = $operation === self::ADD ? new AddTagToTripDetailAction() : new DeleteTagFromTripActionDetail();
        $instns->handle($id, $tagId, null);
    }
}