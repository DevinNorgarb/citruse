<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorRequest extends FormRequest
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
            'business_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'vat_number' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'sales_contact_name' => 'required|string|max:100',
            'sales_contact_email' => 'required|email|max:100',
            'sales_contact_phone' => 'required|string|max:20',
            'logistics_contact_name' => 'nullable|string|max:100',
            'logistics_contact_email' => 'nullable|email|max:100',
            'logistics_contact_phone' => 'nullable|string|max:20',
            'credit_terms' => 'nullable|string|max:100',
            'credit_limit' => 'nullable|numeric|min:0',
            'currency' => 'required|string|size:3',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'business_name' => 'business name',
            'vat_number' => 'VAT number',
            'sales_contact_name' => 'sales contact name',
            'sales_contact_email' => 'sales contact email',
            'sales_contact_phone' => 'sales contact phone',
            'credit_limit' => 'credit limit',
        ];
    }
}
