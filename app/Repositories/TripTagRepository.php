<?php

namespace App\Repositories;

use App\Models\Triptag;
use Illuminate\Database\Eloquent\Collection;

class TripTagRepository extends BaseRepository
{
    public function model()
    {
        return new Triptag();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function search($data): Collection
    {
        return new Collection();
    }

    /**
     * @param int $id
     * @param bool|null $forExpenseOnly
     * @param bool|null $canChoose
     * @return Collection
     */
    public function all(int $id, ?bool $forExpenseOnly = false, ?bool $canChoose = true): Collection
    {
        $tags = $this->model();

        if (!is_null($canChoose) && $canChoose == false) {
            $tags = $tags->where('can_choose', false);
        } else {
            $tags = $tags->where('can_choose', true);
        }

        if (!is_null($forExpenseOnly)) {
            $tags = $tags->where('for_expense_only', $forExpenseOnly);
        }

        return $tags->get();
    }
}