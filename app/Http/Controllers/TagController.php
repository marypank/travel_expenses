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

    /**
     * @OA\Get(
     *     path="/tags",
     *     description="Get all tags",
     *     tags={"Tags"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all tags",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TagResource")
     *         ),
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      )
     *    )
     * )
     */
    public function index()
    {
        return TagResource::collection($this->tagService->all());
    }

    /**
     * @OA\Post(
     *     path="/tags",
     *     description="Create tag",
     *     tags={"Tags"},
     *     security={{"bearer_token":{}}},
     *     summary="Create tag",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     description="tag title",
     *                     type="string",
     *                     example="Проезд"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/tags/{id}",
     *     description="Get one tag by id",
     *     tags={"Tags"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one tag by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="tag id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TagResourceItem"),
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      )
     *    )
     * )
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * @OA\Patch(
     *     path="/tags/{id}",
     *     description="Update tag by id",
     *     tags={"Tags"},
     *     security={{"bearer_token":{}}},
     *     summary="Update tag by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Tag id to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     description="tag title",
     *                     type="string",
     *                     example="Проезд"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TagResourceItem"),
     *     ),
     * )
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        return new TagResource($this->tagService->update($tag, TagDtoBase::create($request->validated())));
    }

    /**
     * @OA\Delete(
     *     path="/tags/{id}",
     *     tags={"Tags"},
     *     security={{"bearer_token":{}}},
     *     summary="Deletes a tag",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Tag id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found",
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Deleted",
     *     ),
     * )
     */
    public function destroy(Tag $tag)
    {
        $this->tagService->delete($tag->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
