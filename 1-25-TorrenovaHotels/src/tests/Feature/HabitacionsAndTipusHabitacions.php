<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Habitacion;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionsAndTipusHabitacions extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;

public function test_habitacions_tipus_habitacions_create_factory(){
  
  $habitacion = Habitacion::factory()->create();

  $this->assertDatabaseCount('habitacions',1);

  $this->assertDatabaseHas('habitacions',[
      'llit' => $habitacion->llit,
      'llit_extra' => $habitacion->llit_extra,
      'estat' => $habitacion->estat,
      'tipus_habitacions_id' => $habitacion->tipus_habitacion_id,

  ]);
}
}
