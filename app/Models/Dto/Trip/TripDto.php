<?php

namespace App\Models\Dto\Trip;


class TripDto extends TripDtoBase
{
    public function __construct(array $request)
    {
        $this->title = $request['title'] ?? null;
        $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->userId = $request['userId'] ?? null;
        $this->id = $request['id'] ?? null;
        $this->status = $request['status'] ?? null;
    }

    public function defineFields(): array
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
        ];
    }
}