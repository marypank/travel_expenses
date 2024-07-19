<?php

namespace App\Http\Requests\TripDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Enum\TripStatusEnum;

class SearchTripDetailRequest extends FormRequest
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
            'status' => ['numeric', 'nullable', Rule::enum(TripStatusEnum::class)],
            'title' => ['string', 'nullable'], 
            'dateTo' => ['date', 'nullable', 'after_or_equal:dateFrom'],
            'dateFrom' => ['date', 'nullable'],
            'countryId' => [''],
            'cityId' => ['']
        ];
    }
}
