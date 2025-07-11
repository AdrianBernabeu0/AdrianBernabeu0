<?php

namespace Database\Seeders;

use App\Models\Ciutat;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $todesCiutat = Ciutat::all();
        foreach ($todesCiutat as $ciutat) {
            Hotel::factory()
            ->count(1)
            ->for($ciutat)
            ->create();
    }
}
}