<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vendor::class;
    
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Default password
            'status' => $this->faker->randomElement([0, 1]), // Randomly assign status 0 or 1
        ];
    }
}
