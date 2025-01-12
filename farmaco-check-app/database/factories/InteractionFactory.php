<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medicine_1_id' => Medicine::factory(),
            'medicine_2_id' => Medicine::factory(),
            'severity' => fake()->randomElement(['grave', 'moderada', 'leve']),
            'causes' => fake()->text(),
            'source' => fake()->word(),
        ];
    }

    /**
     * Indicate that the interaction severity is grave.
     */
    public function grave(): static
    {
        return $this->state(fn (array $attributes) => [
            'severity' => 'grave',
        ]);
    }
}