<?php

namespace Database\Seeders;

use App\Models\Pais;
use App\Models\Ciutat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CiutatPaisSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $paises=["Espanya","Estonia","Egipte","Afganistan","Angola"];
    protected $ciutat = ["Barcelona","Madrid","Bogota","Boston","Brasilia"];
    public function run(): void
    {
        $paisNum = max((int) $this->command->ask('Introdueix la quantitat de paisos', 5), 1);

            Pais::factory($paisNum)->pais($this->paises)->create();
        
        $this->command->info("S'han creat $paisNum paisos");

        $CiutatNum = max((int) $this->command->ask('Introdueix la quantitat de ciutats', 5), 1);
        
        $idPais= Pais::pluck('id')->toArray();
        Ciutat::factory($CiutatNum)->ciutat($this->ciutat,$idPais)->create();
        
        $this->command->info("S'han creat $CiutatNum ciutats");
    }
}
