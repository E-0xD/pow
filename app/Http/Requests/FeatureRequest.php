<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeatureRequest extends FormRequest
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
                Rule::unique('features', 'name')->ignore($this->route('feature')),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('features', 'slug')->ignore($this->route('feature')),
            ],
            'description' => 'nullable|string',
            'type' => 'required|in:boolean,string,integer',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This feature name is already in use.',
            'slug.unique' => 'This slug is already in use.',
            'type.in' => 'Please select a valid feature type.',
        ];
    }
}
