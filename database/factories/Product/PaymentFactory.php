<?php

namespace Database\Factories\Product;

use App\Models\Product\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    // Initial order ID
    private static $orderId = 2024661;

    public function definition(): array
    {
        // Use the current order ID and then increment it
        $currentOrderId = self::$orderId++;

        return [
            'order_id' => $currentOrderId,
            'payment_method' => $this->faker->randomElement(["COD", "CASH", "BKASH"]),
            'amount' => $this->faker->numberBetween(500, 10000),
            'status' => $this->faker->randomElement(["success", "pending", "failed"]),
        ];
    }
}
