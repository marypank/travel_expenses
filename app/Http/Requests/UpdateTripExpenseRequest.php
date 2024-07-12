<?php

namespace App\Http\Requests;

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
            'tripDetailId' => ['numeric'],
            'currencyId' => ['numeric'],
            'current' => [], // todo: add decimal rule, error "decimal:2" - The price field must have 2 decimal places
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'title' => ['string'],
            'description' => ['string', 'nullable'],
            'parentId' => ['exists:trip_expenses,id', 'nullable'],
            'payDate' => ['date'],
            'image' => ['string'],
            'price' => [], // todo: add decimal rule
        ];
    }
}
