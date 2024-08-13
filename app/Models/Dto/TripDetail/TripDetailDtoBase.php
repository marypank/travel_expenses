<?php

namespace App\Models\Dto\TripDetail;

use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

abstract class TripDetailDtoBase extends BaseDto
{
    /* todo: protected static const REQUIRED_FIELDS = [
        'update' => [],
        'create' => []
    ]; */

    protected int $id;

    protected int $tripId;

    protected ?string $title;

    protected ?string $slug;

    protected ?Carbon $dateFrom;

    protected ?Carbon $dateTo;

    protected ?string $description;

    protected ?TripStatusEnum $status;

    protected ?int $cityId;

    protected ?int $countryId;

    protected abstract function defineFields(): array;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTripId(): int
    {
        return $this->tripId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getDateFrom(): ?Carbon
    {
        return $this->dateFrom;
    }

    public function getDateTo(): ?Carbon
    {
        return $this->dateTo;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}