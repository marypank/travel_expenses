<?php

namespace App\Models\Dto;

class UpdateTripDetailDto extends TripDetailDtoBase
{

    public function __construct(array $request)
    {
        // todo: а почему нельзя апдейтить остальное, что здесь проихсодит????
        // $this->title = $request['title'] ?? null;
        // $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->id = $request['id'] ?? null;
        $this->status = $request['status'] ?? null;
        $this->cityId = $request['cityId'] ?? null;
        $this->countryId = $request['countryId'] ?? null;
    }

    protected function defineFields(): array
    {
        return [
            'id' => $this->getId(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
        ];
    }
}