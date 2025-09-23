<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Http\Services\TagService;
use App\Models\Dto\Tag\TagDtoBase;
use App\Models\Tag;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function __construct(private readonly TagService $tagService)
    {
        $this->authorizeResource(Tag::class);
    }

    public function index()
    {
        return TagResource::collection($this->tagService->all());
    }

    public function store(StoreTagRequest $request)
    {
        try {
            $this->tagService->create(TagDtoBase::create($request->validated()));
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        return new TagResource($this->tagService->update($tag, TagDtoBase::create($request->validated())));
    }

    public function destroy(Tag $tag)
    {
        $this->tagService->delete($tag->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
