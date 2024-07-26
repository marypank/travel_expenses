<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\Base\BaseDto;

class UpdateTripExpenseDto extends TripExpenseDtoBase 
{
    public function __construct(
        int $id,
        ?int $currencyId = null,
        ?float $currentRate = null,
        ?int $source = null,
        ?string $title = null,
        ?string $description = null,
        ?int $parentId = null,
        ?string $payDate = null, 
        ?float $price = null)
    {
        $this->id = $id;
        $this->currencyId = $currencyId;
        $this->currentCurrencyExchange = $currentRate;
        $this->source = $source;
        $this->title = $title;
        $this->description = $description;
        $this->parentId = $parentId;
        $this->payDate = $payDate; // todo: convert to DateTime
        $this->price = $price;
    }

    function defineFields(): array
    {
        return [
            'id' => $this->getId(),
            'currency_id' => $this->getCurrencyId(),
            'current_currency_exchange' => $this->getCurrentCurrencyExchange(),
            'source' => $this->getSource(), // todo: мб уже сейчас преобразовать в енам, везде
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'parentId' => $this->getParentId(),
            'payDate' => $this->getPayDate(),
            'price' => $this->getPrice(),
        ];
    }
}