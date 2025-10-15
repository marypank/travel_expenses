<?php

namespace App\Models\Dto\TripExpense;

use App\Models\Dto\BaseDto;
use App\Models\Enum\SourceExpenseEnum;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

abstract class TripExpenseDtoBase extends BaseDto
{
    protected const ID = 'id';

    protected const USER_ID = 'user_id';

    protected const TRIP_ID = 'trip_id';

    protected const TITLE = 'title';

    protected const DESCRIPTION = 'description';

    protected const PRICE = 'price';

    protected const SOURCE = 'source';
    
    protected const CURRENCY_ID = 'currency_id';

    protected const CURRENCY_EXCHANGE_RATE = 'currency_exchange_rate';

    protected const PAY_DATE = 'pay_date';

    protected const IMAGE_URL = 'image_url';

    protected int $id;
    
    protected ?int $tripId;

    protected ?string $title;

    protected ?SourceExpenseEnum $source;

    protected ?string $description;

    protected ?float $price;

    protected ?int $currencyId;

    protected ?float $currencyExchangeRate;

    protected ?Carbon $payDate;

    protected ?UploadedFile $imageFile;

    protected ?string $imageUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTripId(): ?int
    {
        return $this->tripId;
    }

    public function getPayDate(): ?Carbon
    {
        return $this->payDate;
    }

    public function getPripce(): ?Carbon
    {
        return $this->price;
    }

    public function getSource(): ?SourceExpenseEnum
    {
        return $this->source;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function getCurrencyExchangeRate(): ?float
    {
        return $this->currencyExchangeRate;
    }

    public function getImageFile(): ?UploadedFile
    {
        return $this->imageFile;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
        
        return $this;
    }
}