<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TierRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tiers', 'name')->ignore($this->route('tier')),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tiers', 'slug')->ignore($this->route('tier')),
            ],
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*.enabled' => 'boolean',
            'features.*.value' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This tier name is already in use.',
            'slug.unique' => 'This slug is already in use.',
        ];
    }
}
