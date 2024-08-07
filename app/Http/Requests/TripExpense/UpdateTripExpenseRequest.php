<?php

namespace App\Http\Requests\TripExpense;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTripExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'currencyId' => ['numeric'],
            'current_rate' => ['decimal:2'],
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'title' => ['string'],
            'description' => ['string', 'nullable'],
            'parentId' => ['exists:trip_expenses,id', 'nullable'],
            'payDate' => ['date'],
            // todo: work with files 'image' => ['string'],
            'price' => ['decimal:2'],
        ];
    }
}
