<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TagResource",
 *     title="TagResource",
 *     description="TagResource",
 *     @OA\Xml(
 *         name="TagResource"
 *     )
 * )
 */
class TagResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data"
     * )
     *
     * @var \App\Virtual\Models\Tag[]
     */
    private $data;
}