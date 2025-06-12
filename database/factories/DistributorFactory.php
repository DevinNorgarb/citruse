<?php

namespace Database\Factories;

use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Distributor>
 */
class DistributorFactory extends Factory
{
    protected $model = Distributor::class;

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
            'credit_terms' => $this->faker->randomElement(['30 days', '60 days', '90 days']),
            'credit_limit' => $this->faker->randomFloat(2, 1000, 100000),
            'currency' => $this->faker->currencyCode(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
