<?php

namespace Tests\Feature;

use App\Models\Ciutat;
use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_admin_access_home(): void
    {
        $admin = User::factory()->create([
            'rol' => 'administrador'
          ]);
      
          $response = $this->actingAs($admin)->get('/home');

        $response->assertStatus(200);
        $response->assertViewIs('home'); // Asegura que carga la vista correcta
        // $response->assertSee('Estado del Hotel'); // Comprueba contenido en la vista
    }
    public function test_assign_user_to_hotel_success()
    {
        // Crea un hotel ficticio (si tienes un modelo Hotel) o usa un valor directo
        $paisId = Pais::factory()->create([
            "nom"=>"PaisProva",
        ]);
        $ciutatId =Ciutat::factory()->create([
            "nom"=>"CiutatProva",
            "pais_id"=>$paisId->id,
        ]);
        $hotelId = Hotel::factory()->create([
            "nom"=>"Hotelprova",
            "direccio"=>"TestDirection",
            "ciutat_id"=>$ciutatId->id,
            "telefon"=>123456789,
            "identificadorHotel"=>"12lo",
        ]);

        // Realiza la solicitud POST para asignar el hotel al usuario
        $response = $this->json('POST', '/api/home/usuariHotel', [
            'nomUsuari' => "recepcioProva",
            'contrasenyaUsuari' => "recepcioProva",
            'idHotel' => $hotelId->id,
        ]);

        // Verifica que la respuesta sea la esperada
        $response->assertStatus(200);
        $response->assertJson([
            'success' => 'Hotel assignat correctament al usuari.',
        ]);
    }
    public function test_fails_when_assigning_hotel()
    {
        // Crea un hotel ficticio (si tienes un modelo Hotel) o usa un valor directo
        $paisId = Pais::factory()->create([
            "nom"=>"PaisProva",
        ]);
        $ciutatId =Ciutat::factory()->create([
            "nom"=>"CiutatProva",
            "pais_id"=>$paisId->id,
        ]);
        $hotelId = Hotel::factory()->create([
            "nom"=>"Hotelprova",
            "direccio"=>"TestDirection",
            "ciutat_id"=>$ciutatId->id,
            "telefon"=>123456789,
            "identificadorHotel"=>"12lo",
        ]);
        // Realiza la solicitud POST para asignar el hotel al usuario pero no enviamos la contraseña para dar error
        $response = $this->json('POST', '/api/home/usuariHotel', [
            'nomUsuari' => "recepcioProva",
            'idHotel' => $hotelId->id,
        ]);

        // Verifica que la respuesta sea la esperada
        $response->assertStatus(500);
    }
}

