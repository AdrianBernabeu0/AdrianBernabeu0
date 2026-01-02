<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Database\Seeders\CiutatPaisSeeders;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      
    
    User::factory()->create([
      'name' => 'admin',
      'rol'=> 'administrador',
      'hotel_id' => null,
      'password'=> bcrypt('admin'),
  ]);
    $this->call(UserSeeder::class);
    $this->call(ciutatPaisSeeders::class);
      $this->call(HotelSeeder::class);
      $this->call(TipusHabitacionAndHabitacionSeeder::class);
      $this->call(ServeiSeeder::class);
      $this->call(ReservaSeeder::class);
      User::factory()->create([
        'name' => 'recepcio',
        'rol'=> 'recepcionista',
        'hotel_id' => 1,
        'password'=> bcrypt('recepcio'),
    ]);

    }
}
