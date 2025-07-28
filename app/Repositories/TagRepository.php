<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository extends BaseRepository
{
    public function model()
    {
        return new Tag();
    }

    public function all(): Collection
    {
        return $this->model()::all();
    }
}