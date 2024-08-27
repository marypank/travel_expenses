<?php

namespace App\Http\Requests\TripTag;

use Illuminate\Foundation\Http\FormRequest;

class SearchTripTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'forExpenseOnly' => ['boolean'],
            'canChoose' => ['boolean'],
        ];
    }
}
