<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     schema="SourceExpenseResource",
 *     title="SourceExpenseResource",
 *     description="SourceExpenseResource",
 * )
 */
class SourceExpenseResource
{
        /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\SourceExpense[]
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
 *     schema="SourceExpenseResourceItem",
 *     title="SourceExpenseResourceItem",
 *     description="SourceExpenseResourceItem",
 * )
 */
class SourceExpenseResourceItem
{
        /**
     * @OA\Property(
     *     title="data",
     *     description="data"
     * )
     *
     * @var \App\Virtual\Models\SourceExpense
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