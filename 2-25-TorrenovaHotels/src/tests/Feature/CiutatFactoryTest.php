<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\Ciutat;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CiutatFactoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_ciutat_factory_creates_random_city()
    {
        // Generem 5 ciutats aleatoris
        $ciutatCount = 5;
        Pais::factory(2)->create();
        $idPais = Pais::pluck('id')->toArray();
        for ($i=0; $i <$ciutatCount; $i++) { 
            Ciutat::factory()
            ->count(1)
                ->state([
                    'pais_id' => $idPais[array_rand($idPais)],
                ])
                ->create();

  
    }
    // Revisem la ciutat s'han creat correctament
    $this->assertCount($ciutatCount, Ciutat::all());
}

}
