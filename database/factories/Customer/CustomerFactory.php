<?php

namespace Database\Factories\Customer;

use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'phone' => $this->faker->phoneNumber,
            'division_id' => $this->faker->numberBetween(1, 8),
            'district_id' => $this->faker->numberBetween(1, 50),
            'upazila_id' => $this->faker->numberBetween(1, 490),
            'address' => $this->faker->address,
        ];
    }
}
