<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pais>
 */
class PaisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->country(),
        ];
    }
    //Aquesta funció et retornarà els noms dels països per defecte i quan ja no tingui el per defecte inventa unes noves.
    public function pais($pais): Factory
{
    return $this->state(new Sequence(function (Sequence $sequence)use($pais) {
        if(count($pais)<=$sequence->index) {
            
            // Si ens quedem sense elements al fitxer retornem dades aleatories amb el
            // Factory per defecte
            return $this->definition();
        }
        $currentTask = $pais[$sequence->index];
        return  [
            'nom' => $currentTask,
        ];

    }));
}
}
