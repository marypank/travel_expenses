<?php

namespace App\Models\Dto\Api;
use App\Models\Dto\BaseDto;

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

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            'id' => (int)$this->ID,
            'code' => (int)$this->NumCode,
            'strCode' => $this->CharCode,
            'nominal' => $this->Nominal,
            'fullName' => $this->Name,
            'value' => $this->Value,
            'previousValue' => $this->Previous
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}