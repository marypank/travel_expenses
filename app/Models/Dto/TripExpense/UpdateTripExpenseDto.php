<?php

namespace App\Models\Dto\TripExpense;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseEnumService;
use App\Models\Dto\TripExpense\TripExpenseDtoBase;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

class UpdateTripExpenseDto extends TripExpenseDtoBase
{
        private function __construct(
        int $id,
        ?string $title,
        ?string $description,
        ?Carbon $payDate,
        ?float $price,
        ?int $currencyId,
        ?float $currencyExchangeRate,
        ?SourceExpenseEnum $source
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->payDate = $payDate;
        $this->price = $price;
        $this->currencyId = $currencyId;
        $this->currencyExchangeRate = $currencyExchangeRate;
        $this->source = $source;
    }

    public static function create(int $tripExpenseId, array $data): UpdateTripExpenseDto
    {
        // todo: вероятно, если что-то хочется обновить на нулл (например, описание и родительский айди), то не получится из-за removeEmptyValues
        if (isset($data['payDate'])) {
            $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);
        }

        if (isset($data['source'])) {
            $data['source'] = (new SourceExpenseEnumService())->getByValue($data['source']);
        }

        return new self(
            $tripExpenseId,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['payDate'] ?? null,
            $data['price'] ?? null,
            $data['currencyId'] ?? null,
            $data['currencyExchangeRate'] ?? null,
            $data['source'] ?? null
        );
    }

    protected function defineFields(): array
    {
        return [
            self::ID => $this->id,
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