<?php

namespace App\Models\Dto\TripExpense;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

class TripExpenseDto extends TripExpenseDtoBase
{
    private function __construct(
        int $tripDetailId,
        int $currencyId,
        float $current,
        SourceExpenseEnum $source,
        string $title,
        Carbon $payDate,
        float $price,
        ?int $parentId = null,
        ?string $description = null)
    {
        $this->tripDetailId = $tripDetailId;
        $this->source = $source;
        $this->currencyId = $currencyId;
        $this->currentCurrencyExchange = $current;
        $this->title = $title;
        $this->description = $description;
        $this->parentId = $parentId;
        $this->payDate = $payDate;
        $this->price = $price;
    }

    public static function create(array $data): TripExpenseDto
    {   
        $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);

        $sourceExpenseService = new SourceExpenseService();
        $data['source'] = isset($data['source']) ? $sourceExpenseService->getByValue($data['source']) : $sourceExpenseService->getDefault();

        return new self(...$data);
    }

    function defineFields(): array
    {
        return [
            self::TRIP_DETAIL_ID => $this->tripDetailId,
            self::SOURCE => $this->source,
            self::CURRENCY_ID => $this->currencyId,
            self::CURRENT_CURRENCY_EXCHANGE => $this->currentCurrencyExchange,
            self::TITLE => $this->title,
            self::DESCRIPTION => $this->description,
            self::PARENT_ID => $this->parentId,
            self::PAY_DATE => $this->payDate,
            self::PRICE => $this->price,
        ];
    }
}