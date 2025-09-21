<?php

namespace App\Http\Requests\Trip;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        !$this->title ?: $this->merge([
            'slug' => $this->slug ?: Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:8'],
            'slug' => ['string', 'min:8'],
            'status' => [Rule::enum(TripStatusEnum::class)],
            'description' => ['string', 'nullable'],
            'dateFrom' => ['date'],
            'dateTo' => ['date', 'after_or_equal:dateFrom'],
        ];
    }
}
