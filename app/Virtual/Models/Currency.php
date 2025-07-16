<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Currency model",
 *     title="Currency model",
 *     @OA\Xml(
 *         name="Currency"
 *     )
 * )
 */
class Currency
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     * )
     *
     * @param int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="fullName",
     *     title="fullName",
     * )
     *
     * @param string $fullName
     */
    private string $fullName;

    /**
     * @OA\Property(
     *     format="string",
     *     description="charName",
     *     title="charName",
     * )
     *
     * @param string $charName
     */
    private string $charName;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="nominal",
     *     title="nominal",
     * )
     *
     * @param int $nominal
     */
    private int $nominal;

    /**
     * @OA\Property(
     *     format="float32",
     *     description="value",
     *     title="value",
     * )
     *
     * @param float $value
     */
    private float $value;
}