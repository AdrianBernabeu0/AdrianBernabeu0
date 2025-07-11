<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Servei;
use Database\Seeders\ServeiSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServeiSeederTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase; 

    public function crea_serveis_usan_factory() 
    {
        $servei = Servei::factory()->create();

        $this->assertDatabaseCount('serveis',1);

        $this->assertDatabaseHas('serveis',[
            'id' => $servei->id,
            'nom' => $servei->nom,
        ]);

    }

    public function creacio_cinc_servei_usan_seeder()
    {
        $this->seed(ServeiSeeder::class);

        $this->assertDatabaseCount('serveis',5);
    }
}
