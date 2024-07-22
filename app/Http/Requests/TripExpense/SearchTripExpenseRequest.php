<?php

namespace App\Http\Requests\TripExpense;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'tripDetailId' => ['required', 'numeric', 'exists:trip_details,id'],
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'parentId' => ['numeric', 'exists:trip_expenses,id'],
            'payDate' => ['date'],
            'withChildren' => ['boolean']
        ];
    }
}
