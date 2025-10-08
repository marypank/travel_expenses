<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

// todo: можно прописать Property внутри Schema. Или отдельно как каждый параметр, а не json
/**
 * @OA\Schema(
 *     schema="Trip",
 *     description="Trip model",
 *     title="Trip model",
 * )
 */
class Trip
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     *     example="11",
     * )
     *
     * @param int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="title",
     *     title="title",
     *     example="Дагестан",
     * )
     *
     * @param string $title
     */
    private string $title;

    /**
     * @OA\Property(
     *     format="string",
     *     description="slug",
     *     title="slug",
     *     example="dagestan",
     * )
     *
     * @param string $slug
     */
    private string $slug;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="status",
     *     title="status",
     *     example="1",
     *     enum={"0", "1", "2", "3"},
     * )
     *
     * @param int $status
     */
    private int $status;

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
     *     format="datetime",
     *     description="date from",
     *     title="dateFrom",
     *     example="2025-10-11T00:00:00.000000Z",
     * )
     *
     * @param \DateTime $dateFrom
     */
    private \DateTime $dateFrom;

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="date to",
     *     title="dateTo",
     *     example="2025-10-19T00:00:00.000000Z",
     * )
     *
     * @param \DateTime $dateTo
     */
    private \DateTime $dateTo;
}