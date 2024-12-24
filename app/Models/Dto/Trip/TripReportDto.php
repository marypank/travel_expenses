<?php

namespace App\Models\Dto\Trip;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class TripReportDto extends BaseDto
{
    private float $totalSum = 0;

    public function __construct(
        private string $title,
        private Carbon $dateFrom,
        private Carbon $dateTo,
        private TripStatusEnum $status,
        private string $currency = '',
        private string $country = '',
        private string $city = ''
    )
    {}

    // todo: не тестировала пока что
    public function addSum(float $sum)
    {
        $this->totalSum += $sum;
    }

    protected function defineFields(): array
    {
        return [
            'title' => $this->title,
            'dateFrom' => $this->dateFrom->format('Y-m-d'),
            'dateTo' => $this->dateTo->format('Y-m-d'),
            'daysCount' => DateHelper::getDifferenceBetweenDays($this->dateFrom, $this->dateTo),
            'totalSum' => 0,
            'status' => TripStatusEnum::RUS_NAMES[$this->status->value],
            'currency' => $this->currency ?? '',
            'country' => $this->country ?? '', // todo: later
            'city' => $this->city ?? '', // todo: later
        ];
    }
}