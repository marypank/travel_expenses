<?php

namespace App\Models\Dto\Trip;

use App\Models\Dto\BaseDto;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

abstract class TripDtoBase extends BaseDto
{
    protected const ID = 'id';

    protected const USER_ID = 'user_id';

    protected const TITLE = 'title';

    protected const SLUG = 'slug';

    protected const DATE_FROM = 'date_from';

    protected const DATE_TO = 'date_to';

    protected const STATUS = 'status';

    protected const DESCRIPTION = 'description';

    protected int $id;

    protected int $userId;
    
    protected ?string $title;

    protected ?string $slug;

    protected ?Carbon $dateFrom = null;

    protected ?Carbon $dateTo = null;

    protected ?TripStatusEnum $status;

    protected ?string $description;

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
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

    public function getStatus(): ?TripStatusEnum
    {
        return $this->status;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}