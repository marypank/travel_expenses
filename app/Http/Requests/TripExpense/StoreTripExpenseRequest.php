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
            'current' => ['required'], // todo: add decimal rule, error "decimal:2" - The price field must have 2 decimal places
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'title' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'parentId' => ['exists:trip_expenses,id', 'nullable'],
            'payDate' => ['required', 'date'],
            'image' => ['string'],
            'price' => ['required'], // todo: add decimal rule
     ];
    }
}
