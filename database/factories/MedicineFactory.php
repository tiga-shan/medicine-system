<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'generic_name' => fake()->word(),
            'category' => fake()->randomElement(['Pain Relief', 'Antibiotics', 'Vitamins']),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 500),
            'stock_quantity' => 100,
            'reorder_level' => 10,
            'expiry_date' => now()->addYear(),
            'requires_prescription' => false,
            'supplier_id' => null,
        ];
    }
}