<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaisFactoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; 

    public function test_pais_factory_creates_random_countries()
    {
        Pais::query()->delete();
        // Generem 5 països aleatoris
        $paisCount = 5;
        Pais::factory(5)->create();
        // Revisem els països s'han creat correctament
        $pais = Pais::all();
        $this->assertCount($paisCount, $pais);
    }

}
