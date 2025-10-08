<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TripResource",
 *     title="TripResource",
 *     description="TripResource",
 * )
 */
class TripResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\Trip[]
     */
    private $data;
}

/**
 * @OA\Schema(
 *     schema="TripResourceItem",
 *     title="TripResourceItem",
 *     description="TripResourceItem",
 * )
 */
class TripResourceItem
{
        /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\Trip
     */
    private $data;
}