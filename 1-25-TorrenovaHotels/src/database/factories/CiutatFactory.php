<?php

namespace Database\Factories;

use App\Models\Pais;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ciutat>
 */
class CiutatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition(): array
        {
            return [
                'nom' => fake()->city(),
                'pais_id' => null,
                'updated_at' => now(),
            'created_at' => now(),  
            ];
        }
        //Aquesta funció et retornarà els noms de les ciutats per defecte i quan ja no tingui el per defecte inventa unes noves.
    public function ciutat($ciutat): Factory
{
    return $this->state(new Sequence(function (Sequence $sequence)use($ciutat) {
        if($ciutat===false) {
            // Si ens quedem sense elements al fitxer retornem dades aleatories amb el
            // Factory per defecte
            return $this->definition();
        }
        return  [
            'nom' => $ciutat,
        ];
    }));
}
}
