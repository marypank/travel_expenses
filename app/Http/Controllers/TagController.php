<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\SearchTagRequest;
use App\Http\Resources\TagResource;
use App\Http\Services\TagService;

class TagController extends Controller
{
    public function __construct(private TagService $tagService)
    {}

    public function index(SearchTagRequest $request)
    {
        $request = $request->validated();
        $tags = $this->tagService->all(1, $request['forExpenseOnly'] ?? null, $request['canChoose'] ?? null);

        return TagResource::collection($tags);
    }
}
