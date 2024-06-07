<?php

namespace App\Models\Dto;

class TripDto extends BaseDto
{
    private int $id;

    public function __construct(
        private string $title,
        private string $slug,
        private string $dateFrom,
        private string $dateTo,
        private int $userId
    )
    {
        //
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function setDateFrom(string $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    public function setDateTo(string $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'user_id' => $this->getUserId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
        ];

        if (isset($this->id)) {
            $data['id'] = $this->getId();
        }

        return $this->removeEmptyValues($data);
    }
}