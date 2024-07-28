<?php

namespace App\Models\Dto\TripExpense;

class TripExpenseDto extends TripExpenseDtoBase
{
    public function __construct(
        int $tripDetailId,
        int $currencyId,
        float $current,
        int $source,
        string $title,
        string $payDate,
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

    function defineFields(): array
    {
        return [
            'trip_detail_id' => $this->tripDetailId,
            'source' => $this->source,
            'currency_id' => $this->currencyId,
            'current_currency_exchange' => $this->currentCurrencyExchange,
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'pay_date' => $this->payDate,
            'price' => $this->price,
        ];
    }
}