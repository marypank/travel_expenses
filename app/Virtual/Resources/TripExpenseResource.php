<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TripExpenseResource",
 *     title="TripExpenseResource",
 *     description="TripExpenseResource",
 * )
 */
class TripExpenseResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data"
     * )
     *
     * @var \App\Virtual\Models\TripExpense[]
     */
    private $data;
}

/**
 * @OA\Schema(
 *     schema="TripExpenseResourceItem",
 *     title="TripExpenseResourceItem",
 *     description="TripExpenseResourceItem",
 * )
 */
class TripExpenseResourceItem
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data"
     * )
     *
     * @var \App\Virtual\Models\TripExpense
     */
    private $data;
}