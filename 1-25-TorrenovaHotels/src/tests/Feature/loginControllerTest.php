<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_user_recepcio_can_login()
    {
        $user = User::factory()->create([
            "name"=>"recepcio",
            "email"=>"recepcio@example.es",
            "rol"=>"recepcionista",
            "password"=>"recepcio"
        ]);
        $data=[
            'name'=>'recepcio',
            'password'=>'recepcio'
        ];
        $response= $this->post(route("loginStore"),$data);
        $response->assertRedirect('/rooms/roomManagment');
    }
    public function test_user_admin_can_login()
    {
        $user = User::factory()->create([
            "name"=>"admin",
            "email"=>"admin@example.es",
            "rol"=>"administrador",
            "password"=>"admin"
        ]);
        $data=[
            'name'=>'admin',
            'password'=>'admin'
        ];
        $response= $this->post(route("loginStore"),$data);
        $response->assertRedirect('/home');
    }
    public function test_user_can_logout()
    {
        $user = User::factory()->create([
            "name"=>"recepcioProva",
            "email"=>"recepcioProva@example.es",
            "rol"=>"recepcionista",
        ]);

        // Hacer login
        $response = $this->actingAs($user)->post(route("logout"));
        $response->assertRedirect('/'); // O cualquier URL donde redirijas después del logout

        // Verificar que el usuario está desautenticado
        $this->assertGuest();
    }
    public function test_show_login_form_recepcio()
    {
        $user = User::factory()->create([
            "name"=>"recepcioProva",
            "email"=>"recepcioProva@example.es",
            "rol"=>"recepcionista",
        ]);

        // Hacer login
        $response = $this->actingAs($user)->get("/");
        $response->assertRedirect('/rooms/roomManagment'); 
    }
    public function test_show_login_form_admin()
    {
        $user = User::factory()->create([
            "name"=>"admin",
            "email"=>"recepcioProva@example.es",
            "rol"=>"administrador",
        ]);

        // Hacer login
        $response = $this->actingAs($user)->get("/");
        $response->assertRedirect('/home');
    }
    public function test_show_login_form_client()
    {
        $user = User::factory()->create([
            "name"=>"clientProva",
            "email"=>"recepcioProva@example.es",
            "rol"=>"client",
        ]);

        // Hacer login
        $response = $this->actingAs($user)->get("/");
        $response->assertStatus(200);
    }
    public function test_user_admin_cant_login()
{
    $data=[
        'name'=>'userprovanotenter',
        'password'=>'userprovanotenter'
    ];
    $response= $this->post(route("loginStore"),$data);
    $response->assertRedirect('/');
}
}
