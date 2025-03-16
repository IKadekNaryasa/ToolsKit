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
            'inventory_id' => Str::uuid(),
            'category_id' => Category::pluck('category_id')->random(),
            'tanggal_ivn' => date('Y-m-d'),
            'jumlah_ivn' => 5,
            'vendor' => fake()->sentence(rand(3, 5)),
            'keterangan' => fake()->text(),
            'harga' => fake()->randomFloat(2, 50000, 250000),
            'total' => fake()->randomFloat(2, 200000, 10000000),
        ];
    }
}
