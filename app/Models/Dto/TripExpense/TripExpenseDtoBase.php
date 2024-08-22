<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

abstract class TripExpenseDtoBase extends BaseDto
{

    protected const ID = 'id';
    protected const TRIP_DETAIL_ID = 'trip_detail_id';
    protected const TITLE = 'title';
    protected const DESCRIPTION = 'description';
    protected const PAY_DATE = 'pay_date';
    protected const SOURCE = 'source';
    protected const CURRENCY_ID = 'currency_id';
    protected const CURRENT_CURRENCY_EXCHANGE = 'current_currency_exchange';
    protected const PARENT_ID = 'parent_id';
    protected const PRICE = 'price';

    protected int $id;

    protected int $tripDetailId;

    protected ?string $title = null;

    protected ?string $description = null;

    protected ?SourceExpenseEnum $source = null;

    protected ?int $currencyId = null;

    protected ?int $currentCurrencyExchange = null;

    protected ?int $parentId = null;

    protected ?Carbon $payDate;

    protected ?float $price = null;

    protected abstract function defineFields(): array;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTripDetailId(): int
    {
        return $this->tripDetailId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getSource(): ?SourceExpenseEnum
    {
        return $this->source;
    }

    public function getCurrentCurrencyExchange(): ?float
    {
        return $this->currentCurrencyExchange;
    }

    public function getPayDate(): ?Carbon
    {
        return $this->payDate;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}