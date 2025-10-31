<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioAnalyticsRequest extends FormRequest
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
            'element_type' => 'required|string|max:50',
            'element_id' => 'nullable|string|max:255',
            'page_url' => 'required|string|max:2048',
            'clicked_url' => 'nullable|string|max:2048'
        ];
    }
}
