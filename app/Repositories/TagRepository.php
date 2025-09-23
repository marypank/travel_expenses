<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository extends BaseRepository
{
     public function model()
    {
        return Tag::class;
    }

    public function all(): Collection
    {
        return $this->model()::all();
    }
}