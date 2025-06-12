<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'vat_number' => $this->faker->bothify('VAT########'),
            'registration_number' => $this->faker->bothify('REG########'),
            'sales_contact_name' => $this->faker->name(),
            'sales_contact_email' => $this->faker->unique()->safeEmail(),
            'sales_contact_phone' => $this->faker->phoneNumber(),
            'logistics_contact_name' => $this->faker->name(),
            'logistics_contact_email' => $this->faker->unique()->safeEmail(),
            'logistics_contact_phone' => $this->faker->phoneNumber(),
            'payment_terms' => $this->faker->randomElement(['30 days', '60 days', '90 days']),
            'currency' => $this->faker->currencyCode(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
