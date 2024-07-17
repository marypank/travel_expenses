<?php

namespace App\Http\Requests\TripExpense;

use Illuminate\Foundation\Http\FormRequest;

class SearchTripExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'userId' => ['numeric', 'exists:users,id'],
            'tripDetailId' => ['numeric', 'exists:trip_details,id'],
            'tripId' => ['numeric', 'exists:trips,id'],
        ];
    }
}
