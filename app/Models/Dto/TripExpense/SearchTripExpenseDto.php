<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\Base\BaseDto;

class SearchTripExpenseDto extends TripExpenseDtoBase
{
    // unused
    private bool $withChildren = false;

    public function __construct(
        int $tripDetailId,
        ?int $source = null,
        ?string $payDate = null,
        ?int $parentId = null,
        ?bool $withChildren = false)
    {
        $this->tripDetailId = $tripDetailId;
        $this->source = $source;
        $this->payDate = $payDate;
        $this->parentId = $parentId;
        $this->withChildren = $withChildren;
    }
    
    public function getWithChildren(): bool
    {
        return $this->withChildren;
    }

    function defineFields(): array
    {
        return [
            'trip_detail_id' => $this->getTripDetailId(),
            'source' => $this->getSource(),
            'pay_date' => $this->getPayDate(),
            'parent_id' => $this->getParentId(),
        ];
    }
}