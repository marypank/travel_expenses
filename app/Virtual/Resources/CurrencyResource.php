<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="CurrencyResource",
 *     title="CurrencyResource",
 *     description="CurrencyResource",
 * )
 */
class CurrencyResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\Currency[]
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
 *     schema="CurrencyResourceItem",
 *     title="CurrencyResourceItem",
 *     description="CurrencyResourceItem",
 * )
 */
class CurrencyResourceItem
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\Currency
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