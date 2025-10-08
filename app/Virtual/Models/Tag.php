<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Tag",
 *     description="Tag model",
 *     title="Tag model",
 * )
 */
class Tag
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     *     example="2",
     * )
     *
     * @param int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="title",
     *     title="title",
     *     example="Еда",
     * )
     *
     * @param string $title
     */
    private string $title;
}