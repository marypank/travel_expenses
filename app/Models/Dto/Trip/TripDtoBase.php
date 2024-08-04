<?php

namespace App\Models\Dto\Trip;

use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

abstract class TripDtoBase extends BaseDto
{
    protected ?string $title;

    protected ?string $slug;

    protected Carbon $dateFrom;

    protected Carbon $dateTo;

    protected ?int $userId;

    protected ?int $id = null;

    protected TripStatusEnum $status;

    // todo: не дожно быть конструктора тут
    // public function __construct(array $request)
    // {
        /* $this->title = $request['title'] ?? null;
        $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->userId = $request['userId'] ?? null;
        $this->id = $request['id'] ?? null;
        $this->status = $request['status'] ?? null; */
    // }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /* public function getDateFrom(): Carbon
    {
        return $this->dateFrom;
    }

    public function setDateFrom(string $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): Carbon
    {
        return $this->dateTo;
    }

    public function setDateTo(string $dateTo): self
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

    /* public function toArray($withEmptyValues = false): array
    {
        $data = [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    } */

    protected abstract function defineFields(): array;

    public function toArray($withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }

    protected function toCarbonDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}