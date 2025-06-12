<?php

namespace Database\Factories;

use App\Models\PurchaseOrderLineItem;
use App\Models\PurchaseOrder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrderLineItem>
 */
class PurchaseOrderLineItemFactory extends Factory
{
    protected $model = PurchaseOrderLineItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_order_id' => PurchaseOrder::factory(),
            'product_id' => Product::factory(),
            'quantity_kg' => $this->faker->randomFloat(2, 1, 1000),
            'required_delivery_date' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'total_value_ex_vat' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
