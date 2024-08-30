<?php

namespace App\Http\Services;

use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;

class TagService extends BaseService
{
    public function __construct(TagRepository $mainRepository)
    {
        parent::__construct($mainRepository);
    }

     /**
     * @param array $dto
     * @return Collection
     */
    public function search($dto): Collection
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
        return $this->mainRepository->all($id, $forExpenseOnly, $canChoose);
    }
}