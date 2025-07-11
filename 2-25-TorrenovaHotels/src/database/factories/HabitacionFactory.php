<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HabitacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estat = ['ocupat', 'lliure', 'bloquejat'];
        return [
            'nom' => fake()->numberBetween(01, 250),
            'llit' => fake()->numberBetween(2, 4),
            'llit_extra' => fake()->numberBetween(0, 2),
            'ocupants_habitacio' => fake()->numberBetween(1, 5),
            'estat' => $estat[rand(0, 1)],
            'imatge' => json_encode([
                "https://picsum.photos/" . fake()->numberBetween(100, 500),
                "https://picsum.photos/" . fake()->numberBetween(100, 500),
                "https://picsum.photos/" . fake()->numberBetween(100, 500)
            ]),
        
            'observation' => fake()->name(),
            'tipus_habitacions_id' => null,
            'hotel_id' => null
        ];
    }
}
