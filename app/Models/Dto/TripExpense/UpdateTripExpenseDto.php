<?php

namespace App\Models\Dto\TripExpense;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseService;
use App\Models\Dto\Base\BaseDto;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;

class UpdateTripExpenseDto extends TripExpenseDtoBase 
{
    private function __construct(
        int $id,
        ?int $currencyId,
        ?float $currentRate,
        ?SourceExpenseEnum $source,
        ?string $title,
        ?string $description,
        ?int $parentId,
        ?Carbon $payDate, 
        ?float $price)
    {
        $this->id = $id;
        $this->currencyId = $currencyId;
        $this->currentCurrencyExchange = $currentRate;
        $this->source = $source;
        $this->title = $title;
        $this->description = $description;
        $this->parentId = $parentId;
        $this->payDate = $payDate;
        $this->price = $price;
    }

    public static function create(int $id, array $data): UpdateTripExpenseDto
    {
        // todo: вероятно, если что-то хочется обновить на нулл (например, описание и родительский айди), то не получится из-за removeEmptyValues
        if (isset($data['payDate'])) {
            $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);
        }

        if (isset($data['source'])) {
            $sourceExpenseService = new SourceExpenseService();
            $data['source'] = $sourceExpenseService->getByValue($data['source']);
        }

        return new self(
            $id,
            $data['currencyId'] ?? null,
            $data['currentRate'] ?? null,
            $data['source'] ?? null,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['parentId'] ?? null,
            $data['payDate'] ?? null,
            $data['price'] ?? null
        );
    }

    function defineFields(): array
    {
        return [
            'id' => $this->id,
            'currency_id' => $this->currencyId,
            'current_currency_exchange' => $this->currentCurrencyExchange,
            'source' => $this->source,
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'pay_date' => $this->payDate,
            'price' => $this->price,
        ];
    }
}