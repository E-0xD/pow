<?php

namespace App\Http\Requests;

use App\Enums\PortfolioStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', new Enum(PortfolioStatus::class)],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'file_path' => ['required', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
        ];
    }
}