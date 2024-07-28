<?php

namespace App\Http\Requests\TripExpense;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTripExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'tripDetailId' => ['required', 'numeric'],
            'currencyId' => ['required', 'numeric'],
            'current' => ['required', 'decimal:2'],
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'title' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'parentId' => ['exists:trip_expenses,id', 'nullable'],
            'payDate' => ['required', 'date'],
            'price' => ['required', 'decimal:2'],
     ];
    }
}
