<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'medicine_1_id' => Medicine::factory(),  // Cria um medicamento para o primeiro medicamento da interação
            'medicine_2_id' => Medicine::factory(),  // Cria um medicamento para o segundo medicamento da interação
            'severity' => $this->faker->randomElement(['grave', 'moderada', 'leve']),
            'causes' => $this->faker->text(),
            'source' => $this->faker->word(),
        ];
    }
}
