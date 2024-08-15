<?php

namespace App\Http\Requests\TripDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTripDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'title' => ['string'],
            'slug' => ['string'],
            'dateFrom' => ['date'],
            'dateTo' => ['date', 'after_or_equal:dateFrom'],
            'description' => ['string', 'nullable'],
            'status' => ['numeric'],
            'countryId' => ['numeric', Rule::requiredIf($this->cityId)],
            'cityId' => ['numeric', Rule::requiredIf($this->countryId)],
        ];
    }
}
