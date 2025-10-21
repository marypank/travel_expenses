<?php

namespace App\Virtual\Models;

use DateTime;
use Illuminate\Http\UploadedFile;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TripExpense",
 *     description="TripExpense model",
 *     title="TripExpense model",
 * )
 */
class TripExpense
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     *     example="1",
     * )
     *
     * @param int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="tripId",
     *     title="tripId",
     *     example="2",
     * )
     *
     * @param int $tripId
     */
    private int $tripId;

    /**
     * @OA\Property(
     *     format="string",
     *     description="title",
     *     title="title",
     *     example="Билеты на самолет",
     * )
     *
     * @param string $title
     */
    private string $title;

    /**
     * @OA\Property(
     *     format="string",
     *     description="description",
     *     title="description",
     *     example=null,
     * )
     *
     * @param string $description
     */
    private string $description;
    
    /**
     * @OA\Property(
     *     format="float",
     *     description="price",
     *     title="price",
     *     example=12900.99,
     * )
     *
     * @param float $price
     */
    private float $price;
    
    /**
     * @OA\Property(
     *     format="int64",
     *     description="currencyId",
     *     title="currencyId",
     *     example="643",
     * )
     *
     * @param int $currencyId
     */
    private int $currencyId;

    /**
     * @OA\Property(
     *     format="float",
     *     description="currencyExchangeRate",
     *     title="currencyExchangeRate",
     *     example=1,
     * )
     *
     * @param float $currencyExchangeRate
     */
    private float $currencyExchangeRate;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="source",
     *     title="source",
     *     example="1",
     *     enum={"0", "1"},
     * )
     *
     * @param int $source
     */
    private int $source;

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="pay date",
     *     title="payDate",
     *     example="2025-10-12T00:00:00.000000Z",
     * )
     *
     * @param \DateTime $payDate
     */
    private \DateTime $payDate;

    /**
     * @OA\Property(
     *     format="file",
     *     description="image file",
     *     title="imageFile",
     *     example=null,
     * )
     *
     * @param UploadedFile $imageFile
     */
    private UploadedFile $imageFile;

    /**
     * @OA\Property(
     *     format="string",
     *     description="imageUrl",
     *     title="imageUrl",
     *     example=null,
     * )
     *
     * @param string $imageUrl
     */
    private string $imageUrl;
}