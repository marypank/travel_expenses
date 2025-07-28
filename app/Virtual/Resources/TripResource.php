<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TripResource",
 *     title="TripResource",
 *     description="TripResource",
 *     @OA\Xml(
 *         name="TripResource"
 *     )
 * )
 */
class TripResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data"
     * )
     *
     * @var \App\Virtual\Models\Trip[]
     */
    private $data;
}