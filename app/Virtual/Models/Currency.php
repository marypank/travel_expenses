<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Currency",
 *     description="Currency model",
 *     title="Currency model",
 * )
 */
class Currency
{
    /**
     * @OA\Property(
     *     format="string",
     *     description="id",
     *     title="id",
     *     example="036",
     * )
     *
     * @param string $id
     */
    private string $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="fullName",
     *     title="fullName",
     *     example="Австралийский доллар",
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
     *     example="AUD",
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
     *     example=1,
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
     *     example=51.0225,
     * )
     *
     * @param float $value
     */
    private float $value;
}