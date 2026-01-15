<?php

namespace App\Http\Requests;

use App\Enums\BillingCycle;
use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
        $billingCycles = implode(',', array_map(fn($case) => $case->value, BillingCycle::cases()));
        
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tier_id' => 'required|exists:tiers,id',
            'price' => 'nullable|numeric|min:0',
            'billing_cycle' => 'required|in:' . $billingCycles,
            'duration' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
            'paystack_plan_code' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Plan name is required.',
            'tier_id.required' => 'Please select a tier for this plan.',
            'tier_id.exists' => 'The selected tier does not exist.',
            'price.numeric' => 'Price must be a valid number.',
            'billing_cycle.required' => 'Billing cycle is required.',
        ];
    }
}
