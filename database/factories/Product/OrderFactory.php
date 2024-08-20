<?php

namespace Database\Factories\Product;

use App\Models\Product\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{

    protected $model = Order::class;

    // Initial order ID
    private static $orderId = 2024661;

    public function definition(): array
    {
        // Use the current order ID and then increment it
        $currentOrderId = self::$orderId++;

        return [
            'order_id' => $currentOrderId,
            'customer_id' => $this->faker->numberBetween(1, 100),
            'total_amount' => $this->faker->numberBetween(100, 10000),
            'type' => $this->faker->randomElement(["Online", "POS"]),
            'status' => $this->faker->randomElement(["Order Placed", "Order Verified", "Order Ready to Ship", "Order Handover to Courier", "Order Delivered", "Order Cancelled"]),
            'store_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
