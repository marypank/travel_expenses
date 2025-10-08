<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SourceExpense",
 *     description="SourceExpense model",
 *     title="SourceExpense model",
 * )
 */
class SourceExpense
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
     *     format="string",
     *     description="name",
     *     title="name",
     *     example="Card",
     * )
     *
     * @param string $name
     */
    private string $name;
}