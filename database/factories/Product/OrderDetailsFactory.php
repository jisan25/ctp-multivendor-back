<?php

namespace Database\Factories\Product;

use App\Models\Product\OrderDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    protected $model = OrderDetails::class;
    // Initial order ID
    private static $orderId = 2024661;
    public function definition(): array
    {
        // Use the current order ID and then increment it
        $currentOrderId = self::$orderId++;
        return [
            'order_id' => $currentOrderId,
            'product_id' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(500, 10000),
            'delivery_fee' => $this->faker->randomElement([60, 120]),
        ];
    }
}
