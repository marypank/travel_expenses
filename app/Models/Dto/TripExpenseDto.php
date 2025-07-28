<?php

namespace App\Models\Dto;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

// todo: посмотреть можно ли сделать класс только readonly, а также сделать это с другими dto
class TripExpenseDto extends TripExpenseDtoBase
{
    private function __construct(
        int $tripId,
        string $title,
        ?string $description = null,
        float $price,
        Carbon $payDate,
        int $currencyId,
        float $currencyExchangeRate,
        SourceExpenseEnum $source)
    {
        $this->tripId = $tripId;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->payDate = $payDate;
        $this->currencyId = $currencyId;
        $this->currencyExchangeRate = $currencyExchangeRate;
        $this->source = $source;
    }

    public static function create(array $data): TripExpenseDto
    {
        $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);

        $sourceExpenseService = new SourceExpenseService();
        $data['source'] = isset($data['source']) ? $sourceExpenseService->getByValue($data['source']) : $sourceExpenseService->getDefault();

        return new self(...$data);
    }

    protected function defineFields(): array
    {
        return [
            self::TRIP_ID => $this->tripId,
            self::TITLE => $this->title,
            self::DESCRIPTION => $this->description,
            self::SOURCE => $this->source,
            self::PAY_DATE => $this->payDate,
            self::PRICE => $this->price,
            self::CURRENCY_ID => $this->currencyId,
            self::CURRENCY_EXCHANGE_RATE => $this->currencyExchangeRate,
        ];
    }
}