<?php

namespace App\Http\Services\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SearchInterface
{
    public function search(): Collection;

    public function getById(): ?Model;
}