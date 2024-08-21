<?php

namespace App\Models\Dto\TripExpense;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

class TripExpenseDto extends TripExpenseDtoBase
{
    private function __construct(
        int $tripDetailId,
        int $currencyId,
        float $current,
        SourceExpenseEnum $source,
        string $title,
        Carbon $payDate,
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

    public static function create(array $data): TripExpenseDto
    {   
        $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);

        $sourceExpenseService = new SourceExpenseService();
        $data['source'] = isset($data['source']) ? $sourceExpenseService->getByValue($data['source']) : $sourceExpenseService->getDefault();

        return new self(...$data);
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