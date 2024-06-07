<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'userId' => ['required', 'numeric', 'exists:users,id'],
            'title' => ['required', 'string', 'min:16'],
            'slug' => ['required', 'string', 'min:16'],
            'budget' => ['decimal:2,4'],
            'dateFrom' => ['date'],
            'dateTo' => ['date'],
        ];
    }
}
