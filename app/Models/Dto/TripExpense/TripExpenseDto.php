<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\Base\BaseDto;

class TripExpenseDto extends BaseDto
{
    protected ?int $id = null;

    protected ?int $tripDetailId;

    protected ?string $title;

    protected ?string $description;

    protected int $source;

    protected ?string $currencyId;

    protected ?int $currentCurrencyExchange;

    protected ?int $parentId;

    protected ?string $payDate;

    protected ?string $image;

    protected ?float $price;

    public function __construct(array $params)
    {
        $this->id = $params['id'] ?? null;
        $this->tripDetailId = $params['tripDetailId'] ?? null;
        $this->source = $params['source'] ?? null;
        $this->currencyId = $params['currencyId'] ?? null;
        $this->currentCurrencyExchange = $params['current'] ?? null;
        $this->title = $params['title'] ?? null;
        $this->description = $params['description'] ?? null;
        $this->parentId = $params['parentId'] ?? null;
        $this->payDate = $params['payDate'] ?? null;
        $this->image = $params['image'] ?? null;
        $this->price = $params['price'] ?? null;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            // 'id' => $this->id,
            'trip_detail_id' => $this->tripDetailId,
            'source' => $this->source,
            'currency_id' => $this->currencyId,
            'current_currency_exchange' => $this->currentCurrencyExchange,
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'pay_date' => $this->payDate,
            'price' => $this->price,
            'image' => $this->image,
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}