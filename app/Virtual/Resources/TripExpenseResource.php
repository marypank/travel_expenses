<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="TripExpenseResource",
 *     title="TripExpenseResource",
 *     description="TripExpenseResource",
 *     @OA\Xml(
 *         name="TripExpenseResource"
 *     )
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