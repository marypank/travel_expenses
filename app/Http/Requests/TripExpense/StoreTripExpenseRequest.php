<?php

namespace App\Http\Requests\TripExpense;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTripExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tripId' => ['required', 'numeric'],
            'title' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'payDate' => ['required', 'date'],
            'price' => ['required', 'decimal:2'],
            'currencyId' => ['required', 'numeric'],
            'currencyExchangeRate' => ['required', 'decimal:2'],
            'source' => [Rule::enum(SourceExpenseEnum::class)],
            'imageFile' => ['file', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }
}
