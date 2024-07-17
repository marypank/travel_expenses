<?php

namespace App\Http\Requests\TripDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTripDetailRequest extends FormRequest
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
            'tripId' => ['required', 'numeric', 'exists:trips,id'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'dateFrom' => ['required', 'date'],
            'dateTo' => ['required', 'date'],
            'description' => ['string', 'nullable'],
            'status' => ['number'],
            'countryId' => ['required', 'numeric'],
            'cityId' => ['required', 'numeric'],
        ];
    }
}
