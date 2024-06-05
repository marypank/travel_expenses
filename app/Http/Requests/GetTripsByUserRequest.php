<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'status' => ['numeric', 'nullable'],
            'dateTo' => ['date', 'nullable'],
            'dateFrom' => ['date', 'nullable'],
        ];
    }
}
