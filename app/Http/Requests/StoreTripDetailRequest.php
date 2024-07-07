<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
            'country_id' => ['required', 'string'],
            'city_id' => ['required', 'string'],
        ];
    }
}
