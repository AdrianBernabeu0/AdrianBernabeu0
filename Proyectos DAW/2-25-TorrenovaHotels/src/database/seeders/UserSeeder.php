<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(?string $userRecepcionista = null, ?int $idHotel = null): void
    {
      if ($userRecepcionista === 'si') {
        User::factory()
        ->state([
          'rol' => 'recepcionista',
          'hotel_id' => $idHotel,
        ])
        ->create();

      }else{
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
          User::factory()
          ->count(1)
          ->state([
            'hotel_id' => $hotel->id,
        ])
          ->create();
        }
      }
    }
}
