<?php

namespace App\Http\Requests\Trip;

use App\Http\Actions\BaseTagActionInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TripTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:trips,id'],
            'tagId' => ['required', 'exists:tags,id'],
            'operation' => ['required', Rule::in([BaseTagActionInterface::ADD, BaseTagActionInterface::DELETE])]
        ];
    }
}
