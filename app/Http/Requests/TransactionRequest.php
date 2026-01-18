<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatus;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        $statuses = implode(',', array_map(fn($case) => $case->value, TransactionStatus::cases()));

        return [
            'status' => 'required|in:' . $statuses,
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
