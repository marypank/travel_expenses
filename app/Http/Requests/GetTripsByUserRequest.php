<?php

namespace App\Http\Requests;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTripsByUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'userId' => ['required', 'numeric', 'exists:users,id'],
            'status' => ['numeric', 'nullable', Rule::enum(TripStatusEnum::class)],
            'dateTo' => ['date', 'nullable'],
            'dateFrom' => ['date', 'nullable'],
        ];
    }
}
