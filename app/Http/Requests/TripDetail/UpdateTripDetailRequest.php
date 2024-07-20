<?php

namespace App\Http\Requests\TripDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'tripId' => ['numeric', 'exists:trips,id'],
            'title' => ['string', 'nullable'],
            'slug' => ['string'],
            'dateFrom' => ['date'],
            'dateTo' => ['date'],
            'description' => ['string', 'nullable'],
            'status' => ['numeric'],
            'countryId' => ['numeric'],
            'cityId' => ['numeric'],
        ];
    }
}
