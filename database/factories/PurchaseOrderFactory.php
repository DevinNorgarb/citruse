<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Distributor;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'distributor_id' => Distributor::factory(),
            'supplier_id' => Supplier::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'completed']),
        ];
    }
}
