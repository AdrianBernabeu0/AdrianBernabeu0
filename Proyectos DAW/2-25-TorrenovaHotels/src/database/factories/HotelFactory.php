<?php

namespace Database\Factories;

use App\Models\ciutat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'nom' => fake()->name(),
        'direccio' => fake()->address(),
        'ciutat_id' => null,
        'telefon' => fake()->phoneNumber(),
        'email' => fake()->unique()->safeEmail(),
        'identificadorHotel' => fake()->name(),
    ];
    }
}
