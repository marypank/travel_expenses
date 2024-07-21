<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\Base\BaseDto;

abstract class TripExpenseDtoBase extends BaseDto
{
    protected ?int $id = null;

    protected ?int $tripDetailId = null;

    protected ?string $title = null;

    protected ?string $description = null;

    protected ?int $source = null;

    protected ?string $currencyId = null;

    protected ?int $currentCurrencyExchange = null;

    protected ?int $parentId = null;

    protected ?string $payDate = null;

    protected ?string $image = null;

    protected ?float $price = null;

    protected abstract function defineFields(): array;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $descr): self
    {
        $this->description = $descr;

        return $this;
    }

    public function setTripDetailId(?int $tripDetailId): self
    {
        $this->tripDetailId = $tripDetailId;

        return $this;
    }

    public function getTripDetailId(): ?int
    {
        return $this->tripDetailId;
    }

    // todo: maybe Enum $source
    public function setSource(int $source): self
    {
        $this->source = $source;
        
        return $this;
    }

    public function getSource(): ?int
    {
        return $this->source;
    }

    public function setCurrentCurrencyExchange(float $curExch): self
    {
        $this->currentCurrencyExchange = $curExch;
        
        return $this;
    }

    public function getCurrentCurrencyExchange(): ?float
    {
        return $this->currentCurrencyExchange;
    }

    public function setPayDate(string $payDate): self
    {
        $this->payDate = $payDate;

        return $this;
    }

    public function getPayDate(): ?string
    {
        return $this->payDate;
    }

    public function setCurrencyId(int $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setParentId(?int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
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