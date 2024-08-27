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
     * @param bool $forExpenseOnly
     * @param bool $canChoose
     * @return Collection
     */
    public function all(int $id, bool $forExpenseOnly = false, ?bool $canChoose = true): Collection
    {
        $tags = $this->model()
            ->where('can_choose', $canChoose);

        if ($tags == false) {
            $tags = $tags->where('can_choose', false);
        }
        
        if ($forExpenseOnly) {
            $tags = $tags->where('for_expense_only', true);
        }

        return $tags->get();
    }
}