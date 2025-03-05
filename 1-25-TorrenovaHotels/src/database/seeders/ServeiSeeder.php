<?php

namespace Database\Seeders;

use App\Models\Habitacion;
use App\Models\Servei;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServeiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habitacions=Habitacion::all();
        foreach ($habitacions as $habitacion) {
            Servei::factory()->count(3)
            ->for($habitacion)
            ->create(); 
        }   
    }
}
