<?php

namespace App\Http\Requests;

use App\Enums\PortfolioVisibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class PortfolioUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('portfolios')->ignore($this->portfolio),
            ],

            'visibility' => ['required', new Enum(PortfolioVisibility::class) ],
            'theme' => ['nullable', 'string'],
            'typography' => ['nullable'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
        ];
    }
}
