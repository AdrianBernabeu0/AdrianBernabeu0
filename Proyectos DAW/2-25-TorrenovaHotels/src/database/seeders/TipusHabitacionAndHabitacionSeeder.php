<?php

namespace Database\Seeders;


use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\TipusHabitacion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipusHabitacionAndHabitacionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(?int $cantidadTipusHabitacion = null, ?int $cantidadHabitacion = null, ?int $idHotel = null): void
  {
    //Demana la quantitat dels tipus d'habitacions
    if ($cantidadTipusHabitacion === null) {
      $cantidadTipusHabitacion = max((int) $this->command->ask('Introdueix la quantitat de tipus d\'habitacions', 5), 1);
    }
    if ($cantidadHabitacion === null) {
      $cantidadHabitacion = max((int) $this->command->ask('Introdueix la quantitat d\'habitacions per tipus d\'habitacions', 10), 1);
    }
    if ($idHotel === null) {
      //Demana la quantitat de les habitacions
      $hotel = Hotel::pluck('id')->toArray();
      //Inserim els tipus d'habitacions
      TipusHabitacion::factory()->count($cantidadTipusHabitacion)->create();
      //Inserim les habitacions
      $tipusHabitacionsID = TipusHabitacion::pluck('id')->toArray();
      $hotetID = Hotel::pluck('id')->toArray();
      for ($i = 1; $i <= $cantidadHabitacion; $i++) {
        Habitacion::factory()->count(5)
          ->state([
            'hotel_id' => $hotetID[array_rand($hotetID)],
            'tipus_habitacions_id' => $tipusHabitacionsID[array_rand($tipusHabitacionsID)],
          ])
          ->create();
      }
    } else {
      $tipusHabitacionsCreades = TipusHabitacion::factory()
        ->count($cantidadTipusHabitacion)
        ->create();
      $idTipusHabitacions = $tipusHabitacionsCreades->pluck('id')->toArray();

      for ($i=1; $i <= $cantidadHabitacion; $i++) { 
      Habitacion::factory()
      ->count(1)
      ->state([
        'tipus_habitacions_id' => $idTipusHabitacions[array_rand($idTipusHabitacions)],
        'hotel_id' => $idHotel
      ])
      ->create();
    }

    }

    if (isset($this->command)) {
      $this->command->info("S'han creat $cantidadTipusHabitacion tipus d'habitacions amb $cantidadHabitacion habitacions per cada tipus.");
    }
  }

}
