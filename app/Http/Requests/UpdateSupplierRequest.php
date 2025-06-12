<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'business_name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:100',
            'vat_number' => 'sometimes|required|string|max:50|unique:suppliers,vat_number,' . $this->supplier->id,
            'registration_number' => 'nullable|string|max:50',
            'sales_contact_name' => 'sometimes|required|string|max:100',
            'sales_contact_email' => 'sometimes|required|email|max:100',
            'sales_contact_phone' => 'sometimes|required|string|max:20',
            'logistics_contact_name' => 'nullable|string|max:100',
            'logistics_contact_email' => 'nullable|email|max:100',
            'logistics_contact_phone' => 'nullable|string|max:20',
            'payment_terms' => 'nullable|string|max:100',
            'currency' => 'sometimes|required|string|size:3',
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
        ];
    }
}
