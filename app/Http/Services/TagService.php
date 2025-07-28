<?php

namespace App\Http\Services;

use App\Repositories\TagRepository;

class TagService extends BaseService
{
    public function __construct(public TagRepository $tagRepository)
    {
        parent::__construct($tagRepository);
    }
}