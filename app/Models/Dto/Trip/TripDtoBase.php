<?php

namespace App\Models\Dto\Trip;

use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

abstract class TripDtoBase extends BaseDto
{
    protected int $id;

    protected int $userId;
    
    protected ?string $title;

    protected ?string $slug;

    protected Carbon $dateFrom;

    protected Carbon $dateTo;

    protected TripStatusEnum $status;

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /* public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    } */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /* public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    } */

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /* public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    } */

    public function getDateFrom(): Carbon
    {
        return $this->dateFrom;
    }

    /* public function setDateFrom(string $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    } */

    public function getDateTo(): Carbon
    {
        return $this->dateTo;
    }

    /* public function setDateTo(string $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getStatus(): TripStatusEnum
    {
        return $this->status;
    } */

    /* public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    } */
}