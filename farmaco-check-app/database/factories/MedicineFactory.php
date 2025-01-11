<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->unique()->word,
            'active_ingredient' => $this->faker->word,
            'therapeutic_class' => $this->faker->word,
            'dosage' => $this->faker->randomElement(['10mg', '20mg', '25mg', '30mg', '40mg', '50mg']),
            'manufacturer' => $this->faker->company,
        ];
    }
}
