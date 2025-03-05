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

class ReservaControllerTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  use RefreshDatabase;
  public function test_redirect_view_reserva_create(): void
  {
    // Crea un hotel ficticio (si tienes un modelo Hotel) o usa un valor directo
    $paisId = Pais::factory()->create([
      "nom" => "PaisProva",
    ]);
    $ciutatId = Ciutat::factory()->create([
      "nom" => "CiutatProva",
      "pais_id" => $paisId->id,
    ]);
    $hotelId = Hotel::factory()->create([
      "nom" => "Hotelprova",
      "direccio" => "TestDirection",
      "ciutat_id" => $ciutatId->id,
      "telefon" => 123456789,
      "identificadorHotel" => "12lo",
    ]);
    $tipusHabitacionId = TipusHabitacion::factory()->create();
    $habitacion = Habitacion::factory()->create([
      "nom" => 300,
      "llit" => 2,
      "llit_extra" => 0,
      "ocupants_habitacio" => 2,
      "estat" => "lliure",
      "observation" => "Ransom Schulist",
      "tipus_habitacions_id" => $tipusHabitacionId->id,
      "hotel_id" => $hotelId->id,
    ]);
    $user = User::factory()->create([
      "name" => "recepcio",
      "email" => "recepcioProva@example.es",
      "rol" => "recepcionista",
      "hotel_id" => $hotelId->id
    ]);
    $response = $this->actingAs($user)->get(route("reserva.createReserva"));

    $response->assertStatus(200);
  }
  public function test_redirect_view_reserva_create_with_room(): void
  {
      $paisId = Pais::factory()->create([
          "nom" => "PaisProva",
      ]);
  
      $ciutatId = Ciutat::factory()->create([
          "nom" => "CiutatProva",
          "pais_id" => $paisId->id,
      ]);
  
      $hotelId = Hotel::factory()->create([
          "nom" => "Hotelprova",
          "direccio" => "TestDirection",
          "ciutat_id" => $ciutatId->id,
          "telefon" => 123456789,
          "identificadorHotel" => "12lo",
      ]);
  
      $tipusHabitacionId = TipusHabitacion::factory()->create();
  
      $habitacion = Habitacion::factory()->create([
          "nom" => 300,
          "llit" => 2,
          "llit_extra" => 0,
          "ocupants_habitacio" => 2,
          "estat" => "lliure",
          "observation" => "Ransom Schulist",
          "tipus_habitacions_id" => $tipusHabitacionId->id,
          "hotel_id" => $hotelId->id,
      ]);
  
      $user = User::factory()->create([
          "name" => "recepcio",
          "email" => "recepcioProva@example.es",
          "rol" => "recepcionista",
          "hotel_id" => $hotelId->id
      ]);
  
      $response = $this->actingAs($user)->get(route('reserva.createReserva', [
          'idHabitacion' => $habitacion->id,
          'nomTipushabitacio' => $tipusHabitacionId->nom,
      ]));
  
      $response->assertStatus(200);
  
      $response->assertViewHas('habitacio', $habitacion);
      $response->assertViewHas('tipusHabitacions', $tipusHabitacionId);
  
      $response->assertViewIs('reserva.createReserva');
  }
  public function test_redirect_view_reserva_create_with_blocked_room(): void
{
    $paisId = Pais::factory()->create([
        "nom" => "PaisProva",
    ]);
  
    $ciutatId = Ciutat::factory()->create([
        "nom" => "CiutatProva",
        "pais_id" => $paisId->id,
    ]);
  
    $hotelId = Hotel::factory()->create([
        "nom" => "Hotelprova",
        "direccio" => "TestDirection",
        "ciutat_id" => $ciutatId->id,
        "telefon" => 123456789,
        "identificadorHotel" => "12lo",
    ]);
  
    $tipusHabitacionId = TipusHabitacion::factory()->create();
  
    $habitacion = Habitacion::factory()->create([
        "nom" => 300,
        "llit" => 2,
        "llit_extra" => 0,
        "ocupants_habitacio" => 2,
        "estat" => "bloquejat",
        "observation" => "Ransom Schulist",
        "tipus_habitacions_id" => $tipusHabitacionId->id,
        "hotel_id" => $hotelId->id,
    ]);
  
    $user = User::factory()->create([
        "name" => "recepcio",
        "email" => "recepcioProva@example.es",
        "rol" => "recepcionista",
        "hotel_id" => $hotelId->id
    ]);
  
    $response = $this->actingAs($user)->get(route('reserva.createReserva', [
        'idHabitacion' => $habitacion->id,
        'nomTipushabitacio' => $tipusHabitacionId->nom,
    ]));
  
    $response->assertRedirect();
    $response->assertSessionHas('error', "L'habitació està bloquejada");
}

  
  public function test_store_reserva_successfully()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);

    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);
    $tipusHabitacio = TipusHabitacion::factory()->create(['nom' => 'Deluxe']);

    $habitacio = Habitacion::factory()->create(['tipus_habitacions_id' => $tipusHabitacio->id, 'hotel_id' => $hotel->id]);

    $datos = [
      'dadesClient' => 'John Doe',
      'habitacio' => $habitacio->id,
      'tipusHabitacioNom' => $tipusHabitacio->nom,
      'tipusHabitacioPreu' => 100,
      'dataEntrada' => now()->addDay()->toDateTimeString(),
      'dataSortida' => now()->addDays(2)->toDateTimeString(),
      'preu' => 200,
    ];

    $response = $this->post(route('reserva.store'), $datos);

    $this->assertDatabaseHas('reservas', [
      'habitacion_id' => $habitacio->id,
      'preu' => 200,
      'estat' => 'Reserva Confirmada',
    ]);

    $response->assertRedirect(route('hotels.roomManagment'));
    $response->assertSessionHas('success');
  }
  public function test_get_tipus_habitacio_successfully()
  {
    $pais = Pais::factory()->create();
    $ciutat = Ciutat::factory()->create(['pais_id' => $pais->id]);
    $hotel = Hotel::factory()->create(['ciutat_id' => $ciutat->id]);

    $tipusHabitacio = TipusHabitacion::factory()->create([
      'nom' => 'Deluxe',
      'preu_base' => 213.00
    ]);

    $habitacio = Habitacion::factory()->create([
      'tipus_habitacions_id' => $tipusHabitacio->id,
      'hotel_id' => $hotel->id
    ]);

    // Hacer la petición a la API
    $response = $this->postJson(route('reserva.getTipusHabitacio'), [
      'habitacio_id' => $habitacio->id
    ]);

    $response->assertStatus(200)
      ->assertJson([
        'NomTipusHabitacio' => $tipusHabitacio->nom,
        'PreuTipusHabitacio' => $tipusHabitacio->preu_base
      ]);
  }
  public function test_get_tipus_habitacio_fails_when_habitacio_not_found()
  {
    $response = $this->postJson(route('reserva.getTipusHabitacio'), [
      'habitacio_id' => 999999 // ID inexistente
    ]);

    $response->assertStatus(404)
      ->assertJson([
        'error' => 'Habitació no trobada'
      ]);
  }
}
