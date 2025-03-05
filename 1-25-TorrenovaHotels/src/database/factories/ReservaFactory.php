<?php

namespace Database\Factories;

use App\Models\Habitacion;
use App\Models\TipusHabitacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Recollim l'id en un array

        $dataEntrada = $this->faker->dateTimeBetween('now', '+2 month'); // Data d'inici entre avui i 2 anys endavant
        $dataSortida = (clone $dataEntrada)->modify('+' . rand(1, 30) . ' days'); // Data final per que no sigui el mateix dia
        return [
            "habitacion_id" => null, // Se asignará en el seeder
            "data_Entrada" => null, // Se asignará en el seeder
            "data_Sortida" => null, // Se asignará en el seeder
            "check_in" => fake()->boolean(),
            "check_out" => fake()->boolean(),
            "preu" => null, // Se asignará en el seeder
            "usuari_id" => null, // Se asignará en el seeder
            "estat" => "Reserva confirmada",
            "persones_reserva" => fake()->numberBetween(1, 5),
        ];
    }
    public function reservaHabitacion($habitacion): Factory
    {
        return $this->state(new Sequence(function (Sequence $sequence)use($habitacion) {
            if($habitacion===false) {
                return $this->definition();
            }
            return  [
                'nom' => $habitacion,
            ];
        }));
    }
}
