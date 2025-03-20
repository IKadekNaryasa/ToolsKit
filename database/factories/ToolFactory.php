<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MntTool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tool_code' => fake()->unique()->sentence(1),
            'name' => fake()->sentence(rand(1, 2)),
            'condition' => 'Baik',
            'status' => 'available',
            'category_id' => Category::pluck('id')->random()
        ];
    }

    public function maintenance(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'maintenance',
        ]);
    }
    public function repair(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'repair',
        ]);
    }
    public function damaged(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'damaged',
        ]);
    }
    public function borrowed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'borrowed',
        ]);
    }
}
