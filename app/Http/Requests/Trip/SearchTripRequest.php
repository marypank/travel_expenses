<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Enum\TripStatusEnum;

class SearchTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            // 'userId' => ['required', 'numeric', 'exists:users,id'],
            'status' => ['numeric', 'nullable', Rule::enum(TripStatusEnum::class)],
            'dateTo' => ['date', 'nullable', 'after_or_equal:dateFrom'],
            'dateFrom' => ['date', 'nullable'],
        ];
    }
}
