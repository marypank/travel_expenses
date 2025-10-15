<?php

namespace App\Models\Dto\TripExpense;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\SourceExpenseEnumService;
use App\Models\Dto\TripExpense\TripExpenseDtoBase;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

// todo: посмотреть можно ли сделать класс только readonly, а также сделать это с другими dto
class TripExpenseDto extends TripExpenseDtoBase
{
        private function __construct(
        int $tripId,
        string $title,
        float $price,
        Carbon $payDate,
        int $currencyId,
        float $currencyExchangeRate,
        SourceExpenseEnum $source,
        ?string $description = null,
        ?UploadedFile $imageFile = null)
    {
        $this->tripId = $tripId;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->payDate = $payDate;
        $this->currencyId = $currencyId;
        $this->currencyExchangeRate = $currencyExchangeRate;
        $this->source = $source;
        $this->imageFile = $imageFile;
    }

    public static function create(array $data): TripExpenseDto
    {
        $data['payDate'] = DateHelper::toCarbonDate($data['payDate']);

        $sourceExpenseEnumService = new SourceExpenseEnumService();
        $data['source'] = isset($data['source']) ? $sourceExpenseEnumService->getByValue($data['source']) : $sourceExpenseEnumService->getDefault();

        return new self(...$data);
    }

    protected function defineFields(): array
    {
        return [
            self::TRIP_ID => $this->tripId,
            self::TITLE => $this->title,
            self::DESCRIPTION => $this->description,
            self::SOURCE => $this->source,
            self::PAY_DATE => $this->payDate,
            self::PRICE => $this->price,
            self::CURRENCY_ID => $this->currencyId,
            self::CURRENCY_EXCHANGE_RATE => $this->currencyExchangeRate,
            self::IMAGE_URL => $this->imageUrl
        ];
    }
}