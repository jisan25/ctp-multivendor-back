<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'vendor_id' => $this->faker->numberBetween(1, 100),
            'store_name' => $this->faker->company,
            'store_description' => $this->faker->paragraph,
            'store_logo' => 'images/store-logos/' . $this->faker->numberBetween(1, 30) . '.jpg',
            'store_address' => $this->faker->address,
            'store_phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
