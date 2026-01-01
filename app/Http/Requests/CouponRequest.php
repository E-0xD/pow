<?php

namespace App\Http\Requests;

use App\Enums\CouponType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|unique:coupons,code,' . $this->route('coupon'),
            'type' => ['required', new Enum(CouponType::class)],
            'discount_value' => 'nullable|numeric|min:0|max:100|required_if:type,' . CouponType::PLAN_DISCOUNT->value . ',' . CouponType::GLOBAL_DISCOUNT->value,
            'months_value' => 'nullable|integer|min:1|required_if:type,' . CouponType::FREE_MONTHS->value . ',' . CouponType::EXTRA_MONTHS->value,
            'applicable_plan_id' => 'nullable|exists:plans,id|required_if:type,' . CouponType::PLAN_DISCOUNT->value,
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date|after:now',
            'is_active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'This coupon code is already in use.',
            'discount_value.required_if' => 'Discount value is required for discount types.',
            'months_value.required_if' => 'Months value is required for month-based types.',
            'applicable_plan_id.required_if' => 'Applicable plan is required for plan-specific discounts.',
        ];
    }
}