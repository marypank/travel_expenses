<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TagResource",
 *     title="TagResource",
 *     description="TagResource",
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

/**
 * @OA\Schema(
 *     schema="TagResourceItem",
 *     title="TagResourceItem",
 *     description="TagResourceItem",
 * )
 */
class TagResourceItem
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data"
     * )
     *
     * @var \App\Virtual\Models\Tag
     */
    private $data;
}

