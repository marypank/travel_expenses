<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TripStatus",
 *     description="TripStatus model",
 *     title="TripStatus model",
 * )
 */
class TripStatus
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     *     example="0",
     * )
     *
     * @param int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="name",
     *     title="name",
     *     example="Await",
     * )
     *
     * @param string $name
     */
    private string $name;
}