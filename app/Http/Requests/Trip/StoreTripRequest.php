<?php

namespace App\Http\Requests\Trip;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?: Str::slug($this->title),
        ]);
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'userId' => ['required', 'numeric', 'exists:users,id'],
            'title' => ['required', 'string', 'min:8'],
            'slug' => ['required', 'string', 'min:8'],
            'dateFrom' => ['required', 'date'],
            'dateTo' => ['required', 'date', 'after_or_equal:dateFrom'],
            'status' => [Rule::enum(TripStatusEnum::class)],
        ];
    }
}
