<?php

namespace App\Http\Requests\TripDetail;

use App\Http\Actions\BaseTagAction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TripDetailTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:trip_details,id'],
            'tagId' => ['required', 'exists:tags,id'],
            'operation' => ['required', Rule::in([BaseTagAction::ADD, BaseTagAction::DELETE])]
        ];
    }
}
