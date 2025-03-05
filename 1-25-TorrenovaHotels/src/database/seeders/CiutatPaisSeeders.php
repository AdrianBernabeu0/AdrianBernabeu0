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
        //Demanem la quantitat de països i ho creem
        $paisNum = max((int) $this->command->ask('Introdueix la quantitat de paisos', 5), 1);

            Pais::factory($paisNum)->pais($this->paises)->create();
        $this->command->info("S'han creat $paisNum paisos");

        //Demanem la quantitat de ciutats i ho creem

        $CiutatNum = max((int) $this->command->ask('Introdueix la quantitat de ciutats', 5), 1);

        //Recollim els ID dels països després fem un bucle fins a la quantitat desada,
        //en el bucle creem les ciutats i si es demana més el que tenim envia un fals perquè el factory creï ciutats falses.
        $idPais = Pais::pluck('id')->toArray();
        for ($i=0; $i <$CiutatNum ; $i++) { 
            Ciutat::factory()
            ->count(1)
                ->ciutat($this->ciutat[$i]??false)
                ->state([
                    'pais_id' => $idPais[array_rand($idPais)],
                ])
                ->create();
        }
        
        $this->command->info("S'han creat $CiutatNum ciutats");
    }
}
