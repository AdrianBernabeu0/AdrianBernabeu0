<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Ciutat;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\TipusHabitacion;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomControllerTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   */
  public function test_page_checkIn(): void
  {
    $admin = User::factory()->create([
      'rol' => 'administrador',
    ]);

    $response = $this->actingAs($admin)->get('/rooms/checkinList');

    $response->assertStatus(200);
  }



  public function test_room_block_functionality()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);

    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);

    $tipusHabitacio = TipusHabitacion::factory()->create();

    $habitacion = Habitacion::factory()->create([
      'estat' => 'lliure',
      'tipus_habitacions_id' => $tipusHabitacio->id,
      'hotel_id' => $hotel->id,
    ]);

    $response = $this->postJson(route('rooms.roomBlock'), [0 => $habitacion->id]);

    $response->assertStatus(200)
      ->assertJson([
        'id' => $habitacion->id,
        'estat' => 'bloquejat'
      ]);

    $this->assertDatabaseHas('habitacions', [
      'id' => $habitacion->id,
      'estat' => 'bloquejat'
    ]);

    $response = $this->postJson(route('rooms.roomBlock'), [0 => $habitacion->id]);

    $response->assertStatus(200)
      ->assertJson([
        'id' => $habitacion->id,
        'estat' => 'lliure'
      ]);

    $this->assertDatabaseHas('habitacions', [
      'id' => $habitacion->id,
      'estat' => 'lliure'
    ]);
  }

  public function test_show_reserves_success()
  {

    $user = User::factory()->create();
    $this->actingAs($user);

    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);
    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);

    $tipusHabitacio = TipusHabitacion::factory()->create();

    $habitacio = Habitacion::factory()->create(['tipus_habitacions_id' => $tipusHabitacio->id, 'hotel_id' => $hotel->id]);


    $reserva = Reserva::factory()->create([
      'data_Entrada' => '2025-02-15 14:00:00',
      'data_Sortida' => '2025-02-20 12:00:00',
      'preu' => 22.22,
      'habitacion_id' => $habitacio->id,
      'usuari_id' => $user->id,
    ]);

    $response = $this->postJson(route('rooms.reserves'), [$habitacio->id]);

    $response->assertStatus(200);
    $response->assertJsonFragment([
      'id' => $reserva->id,
      'habitacion_id' => $habitacio->id,
      'usuari' => $user->name,
    ]);
  }
  public function test_show_detall_reserva_success()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);
    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);
    $tipusHabitacio = TipusHabitacion::factory()->create();
    $habitacion = Habitacion::factory()->create([
      'tipus_habitacions_id' => $tipusHabitacio->id,
      'hotel_id' => $hotel->id,
    ]);

    $reserva = Reserva::factory()->create([
      'data_Entrada' => '2025-02-15 14:00:00',
      'data_Sortida' => '2025-02-20 12:00:00',
      'preu' => 22.22,
      'habitacion_id' => $habitacion->id,
      'usuari_id' => $user->id,
    ]);

    $response = $this->getJson(route('rooms.detailsReserva', ['id' => $reserva->id]));

    $response->assertStatus(200)
      ->assertJsonFragment([
        'NomUsuari' => $user->name,
        'data_Entrada' => '2025-02-15 14:00:00',
        'data_Sortida' => '2025-02-20 12:00:00',
        'preu' => 22.22,
        'emailUsuari' => $user->email,
      ]);
  }
  public function test_check_out_success()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);
    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);
    $tipusHabitacio = TipusHabitacion::factory()->create();
    $habitacion = Habitacion::factory()->create([
      'tipus_habitacions_id' => $tipusHabitacio->id,
      'hotel_id' => $hotel->id,
      'estat' => 'lliure',
    ]);

    $reserva = Reserva::factory()->create([
      'data_Entrada' => '2025-02-15 14:00:00',
      'data_Sortida' => '2025-02-20 12:00:00',
      'preu' => 22.22,
      'habitacion_id' => $habitacion->id,
      'usuari_id' => $user->id,
      'check_out' => false,
    ]);

    $response = $this->postJson(route('rooms.checkout'), [0 => $reserva->id]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('reservas', [
      'id' => $reserva->id,
      'check_out' => true
    ]);
    $this->assertDatabaseHas('habitacions', [
      'id' => $habitacion->id,
      'estat' => 'lliure'
    ]);
  }

  public function test_check_out_handles_exception()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->postJson(route('rooms.checkout'), [0 => 999999]); //ID que no existe

    $response->assertStatus(500)
      ->assertJsonStructure(['error']);
  }


  public function test_room_block_catch_error()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->postJson(route('rooms.roomBlock'), [0 => 99999]); // ID que no existe

    $response->assertStatus(500);
    $response->assertJsonStructure(['error']);
  }
}
