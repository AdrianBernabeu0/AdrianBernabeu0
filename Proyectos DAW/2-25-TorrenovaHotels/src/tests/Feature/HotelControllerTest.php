<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_page_create_hotels_user_admin(): void
    {
      $admin = User::factory()->create([
        'rol' => 'administrador'
      ]);
  
      $response = $this->actingAs($admin)->get('/hotels/create');
  
      $response->assertStatus(200);
    }
    public function test_store_hotel_successfully()
{
    $admin = User::factory()->create([
        'rol' => 'administrador',
    ]);

    $data = [
        'nom' => 'Hotel Test',
        'direccio' => 'Calle Test 123',
        'ciutat' => 'Barcelona',
        'pais' => 'España',
        'telefon' => '123456789',
        'email' => 'hotel@test.com',
        'identificadorHotel' => 'HT123',
    ];

    $response = $this->actingAs($admin)->post(route('hotels.store'), $data);

    $response->assertViewIs('hotels.seederHotel');
    $response->assertViewHasAll([
        'paisNom' => 'España',
        'ciutatNom' => 'Barcelona',
        'hotelNom' => 'Hotel Test',
        'hotelDireccio' => 'Calle Test 123',
        'hotelTelefon' => '123456789',
        'hotelEmail' => 'hotel@test.com',
        'hotelIdentificador' => 'HT123',
    ]);
}
public function test_store_hotel_validation_errors()
{
    $admin = User::factory()->create([
        'rol' => 'administrador',
    ]);

    $data = [
        'nom' => '',  // Dejar vacío para probar validacion
        'direccio' => 'Calle Test 123',
        'ciutat' => 'Barcelona',
        'pais' => 'España',
        'telefon' => '123456789',
        'email' => 'hotel@test.com',
        'identificadorHotel' => 'HT123',
    ];

    $response = $this->actingAs($admin)->post(route('hotels.store'), $data);

    $response->assertSessionHasErrors(['nom']);
    $response->assertRedirect();
}


    public function test_creation_hotels()
    {
        $admin = User::factory()->create(['rol' => 'administrador']);
    
        $data = [
            'tipusHabitacions' => 5,
            'habitacions' => 10,
            'usuari' => 'si',
            'paisNom' => 'PaisTest',
            'ciutatNom' => 'CiutatTest',
            'hotelNom' => 'HotelTest',
            'hotelDireccio' => 'DireccioTest',
            'hotelTelefon' => '123456789',
            'hotelEmail' => 'test@hotel.com',
            'hotelIdentificador' => 'HT123'
        ];
    
        $response = $this->actingAs($admin)->post(route('hotels.seederHotelStore'), $data);
    
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'S\'ha creat correctament l\'hotel');
    
        $this->assertDatabaseHas('hotels', [
            'nom' => $data['hotelNom'],
            'direccio' => $data['hotelDireccio'],
            'telefon' => $data['hotelTelefon'],
            'email' => $data['hotelEmail'],
            'identificadorHotel' => $data['hotelIdentificador'],
        ]);
    
        $this->assertDatabaseHas('ciutats', [
            'nom' => $data['ciutatNom'],
        ]);
    
        $this->assertDatabaseHas('pais', [
            'nom' => $data['paisNom'],
        ]);
    }
    public function test_creation_hotels_validation()
    {
        $admin = User::factory()->create(['rol' => 'administrador']);
    
        $data = [
            'tipusHabitacions' => '', // Dejar vacío para probar validacion
            'habitacions' => '10',
            'usuari' => 'si',
            'paisNom' => 'PaisTest',
            'ciutatNom' => 'CiutatTest',
            'hotelNom' => 'NomHotel',
            'hotelDireccio' => 'DireccioTest',
            'hotelTelefon' => '123456789',
            'hotelEmail' => 'test@hotel.com',
            'hotelIdentificador' => 'HT123'
        ];
    
        $response = $this->actingAs($admin)->post(route('hotels.seederHotelStore'), $data);
    
        $response->assertSessionHasErrors(['tipusHabitacions']);
        
        $response->assertRedirect();
    }
    
}
