<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TripStatusResource",
 *     title="TripStatusResource",
 *     description="TripStatusResource",
 * )
 */
class TripStatusResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\TripStatus[]
     */
    private $data;

    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     example="",
     * )
     */
    private $message;
}

/**
 * @OA\Schema(
 *     schema="TripStatusResourceItem",
 *     title="TripStatusResourceItem",
 *     description="TripStatusResourceItem",
 * )
 */
class TripStatusResourceItem
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\TripStatus
     */
    private $data;

    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     example="",
     * )
     */
    private $message;
}