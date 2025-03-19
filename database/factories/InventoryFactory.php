<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'category_id' => Category::pluck('id')->random(),
            'date' => date('Y-m-d'),
            'quantity' => 5,
            'vendor' => fake()->sentence(rand(3, 5)),
            'notes' => fake()->text(),
            'price' => fake()->randomFloat(2, 50000, 250000),
            'total' => fake()->randomFloat(2, 200000, 10000000),
        ];
    }
}
