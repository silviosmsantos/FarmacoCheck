<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
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
            'name' => fake()->unique()->word(),
            'active_ingredient' => fake()->word(),
            'therapeutic_class' => fake()->word(),
            'dosage' => fake()->randomElement(['10mg', '20mg', '25mg', '30mg', '40mg', '50mg']),
            'manufacturer' => fake()->company(),
        ];
    }

    /**
     * Indicate that the medicine has a specific dosage.
     */
    public function specificDosage(string $dosage): static
    {
        return $this->state(fn (array $attributes) => [
            'dosage' => $dosage,
        ]);
    }
}
