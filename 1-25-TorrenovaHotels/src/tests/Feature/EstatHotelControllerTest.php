<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Ciutat;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstatHotelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_admin_acces_hotel_status(): void
    {
        $admin = User::factory()->create([
            "name" => "admin",
            "email" => "admin@example.es",
            'rol' => 'administrador'
        ]);
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
        $response = $this->actingAs($admin)->get('/hotels/hotelState/' . $hotelId->id);

        $response->assertStatus(200);
        $response->assertViewIs('hotels.hotelState'); // Asegura que carga la vista correcta
        // $response->assertSee('Estado del Hotel'); // Comprueba contenido en la vista
    }
    public function test_receptionist_access_denied_hotel_status(): void
    {
        $recepcio = User::factory()->create([
            'rol' => 'recepcionista'
        ]);

        $response = $this->actingAs($recepcio)->get('/hotels/hotelState');

        $response->assertStatus(302);
    }
    public function test_shows_error_message_for_hotel(): void
    {
        $recepcio = User::factory()->create([
            'rol' => 'administrador'
        ]);

        $response = $this->actingAs($recepcio)->get('/hotels/hotelState/2');

        // Verificar que la redirección fue a 'home'
        $response->assertRedirect(route('home'));

        // Verificar que el mensaje de error está en la sesión
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Hotel no encontrado', session('error'));
    }
}
