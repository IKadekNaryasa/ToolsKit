<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MntTool>
 */
class MntToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_alat' => Str::random(5),
            'nama_alat' => fake()->sentence(rand(1, 2)),
            'kondisi' => 'Baik',
            'status' => 'tersedia',
            'category_id' => Category::pluck('category_id')->random()
        ];
    }

    public function perawatan(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'perawatan',
        ]);
    }
    public function perbaikan(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'perbaikan',
        ]);
    }
    public function rusak(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rusak',
        ]);
    }
    public function dipinjam(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'dipinjam',
        ]);
    }
}
