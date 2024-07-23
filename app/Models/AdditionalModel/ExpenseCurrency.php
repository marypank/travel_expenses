<?php

namespace App\Models\AdditionalModel;

use App\Models\Dto\Api\CurrencyDto;
use App\Models\Dto\Base\BaseDto;

class ExpenseCurrency extends BaseDto
{
    private int $id;

    private string $title;

    private float $currentRate;

    private string $code;

    private float $rusPrice;

    private float $price;

    public function __construct(int $id, string $title, float $currentRate, string $code, float $price, float $rusPrice)
    {
        $this->id = $id;
        $this->title = $title;
        $this->currentRate = $currentRate;
        $this->code = $code;
        $this->price = $price;
        $this->rusPrice = $rusPrice;
    }

    public static function getCurrent(CurrencyDto $currencyDto, float $currentRate, float $price)
    {
        return new self(
            $currencyDto->getCode(),
            $currencyDto->getName(),
            $currentRate,
            $currencyDto->getStrCode(),
            $price,
            self::calculatePrice($currencyDto->getNominal(), $currentRate, $price)
        );
    }

    private static function calculatePrice(int $nominal, float $currentRate, float $price): float
    {
        // todo: не работает, если номинал не 1
        return $nominal * $currentRate * $price;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'currentRate' => $this->currentRate,
            'price' => $this->price,
            'rusPrice' => $this->rusPrice
        ];

        return $data;
    }

}