<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\TipusHabitacion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creem l'usuari client prova per si de cas no s'hagi creat abans
        User::factory()->create([
            'name' => 'ClientProva',
            'email' => 'ClientProva@gmail.com',
            'rol' => 'client',
            'password' => bcrypt('1234'),
            'hotel_id' => 1,
        ]);
        //Recull els usuaris que nomes tingin el rol client
        $usuaris = User::all()->where("rol", "client")->pluck('id')->toArray();

        //Fem un bucle per recórrer les habitacions per poder connectar-lo amb els tipus d'habitacions com la seva ID per recollir el preu i fer la factoria. 
        
        $habitaciones = Habitacion::all();

        foreach ($habitaciones as $habitacion) {
            $tipusHabitacion = TipusHabitacion::find($habitacion->tipus_habitacions_id);
            if (!$tipusHabitacion) continue; // Si no hay tipo de habitación, saltamos

            for ($i = 0; $i < 10; $i++) {
                do {
                    // Generamos fechas aleatorias
                    $dataEntrada = fake()->dateTimeBetween('now', '+2 months');
                    $dataSortida = (clone $dataEntrada)->modify('+' . rand(1, 7) . ' days');

                    // Verificamos si hay solapamiento con reservas existentes
                    $existeReserva = Reserva::where('habitacion_id', $habitacion->id)
                        ->where(function ($query) use ($dataEntrada, $dataSortida) {
                            $query->whereBetween('data_Entrada', [$dataEntrada->format('Y-m-d'), $dataSortida->format('Y-m-d')])
                                  ->orWhereBetween('data_Sortida', [$dataEntrada->format('Y-m-d'), $dataSortida->format('Y-m-d')])
                                  ->orWhere(function ($query) use ($dataEntrada, $dataSortida) {
                                      $query->where('data_Entrada', '<=', $dataEntrada->format('Y-m-d'))
                                            ->where('data_Sortida', '>=', $dataSortida->format('Y-m-d'));
                                  });
                        })
                        ->exists();
                } while ($existeReserva); // Repetimos si hay solapamiento

                // Crear la reserva con fechas y precios correctos
                Reserva::factory()
                    ->state([
                        'habitacion_id' => $habitacion->id,
                        'data_Entrada' => $dataEntrada->format('Y-m-d'),
                        'data_Sortida' => $dataSortida->format('Y-m-d'),
                        'preu' => $tipusHabitacion->preu_base * rand(2, 7),
                        'usuari_id' => $usuaris[array_rand($usuaris)], // Usuario aleatorio
                    ])
                    ->create();
            }
        }

    }
}
