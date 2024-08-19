<?php

namespace App\Models\Dto\Api;

use App\Models\Dto\Base\BaseDto;

class CurrencyDto extends BaseDto
{
    public function __construct(
        private string $ID,
        private string $NumCode,
        private string $CharCode,
        private int $Nominal,
        private string $Name,
        private float $Value,
        private float $Previous
    )
    {}

    public function getCode(): int
    {
        return (int)$this->NumCode;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function getStrCode(): string
    {
        return $this->CharCode;
    }

    public function getNominal(): int
    {
        return $this->Nominal;
    }

    protected function defineFields(): array
    {
        return [
            'id' => $this->ID,
            'code' => (int)$this->NumCode,
            'strCode' => $this->CharCode,
            'nominal' => $this->Nominal,
            'fullName' => $this->Name,
            'value' => $this->Value,
            'previousValue' => $this->Previous
        ];
    }
}