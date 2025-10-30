<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_id' => ['required', 'exists:templates,id'],
            // 'title' => ['required', 'string', 'max:255'],
            // 'slug' => [
            //     'nullable',
            //     'string',
            //     'max:255',
            //     Rule::unique('user_portfolios')->ignore($this->userPortfolio)
            // ],
            // 'visibility' => ['required', 'in:public,private,password_protected'],
            // 'theme' => ['nullable', 'string'],
            // 'typography' => ['nullable', 'array'],
            // 'expires_at' => ['nullable', 'date', 'after:today'],
            // 'status' => ['required', 'in:draft,published,archived'],
            // 'favicon' => ['nullable', 'image', 'max:1024'],
            // 'meta_title' => ['nullable', 'string', 'max:60'],
            // 'meta_description' => ['nullable', 'string', 'max:160'],
        ];
    }

    // protected function prepareForValidation()
    // {
    //     if ($this->title && !$this->slug) {
    //         $this->merge([
    //             'slug' => Str::slug($this->title)
    //         ]);
    //     }
    // }
}