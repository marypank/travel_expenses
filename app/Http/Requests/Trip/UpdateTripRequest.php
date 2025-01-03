<?php

namespace App\Http\Requests\Trip;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        !$this->title ?: $this->merge([
            'slug' => $this->slug ?: Str::slug($this->title),
        ]);
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:16'],
            'slug' => ['string', 'min:16'],
            // 'budget' => ['decimal:2,4'],
            'status' => ['numeric', Rule::enum(TripStatusEnum::class)],
            'currencyId' => ['decimal:2'],
            'dateFrom' => ['date'],
            'dateTo' => ['date', 'after_or_equal:dateFrom'],
        ];
    }
}
