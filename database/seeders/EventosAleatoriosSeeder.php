<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventosAleatoriosSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $vagas = fake()->numberBetween(10, 150);

            DB::table('eventos')->insert([
                'titulo' => ucfirst(fake()->words(3, true)),
                'tipo' => fake()->randomElement(['workshop', 'palestra', 'hackathon']),
                'data' => fake()->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
                'local' => fake()->randomElement(['Auditório', 'Laboratório 2.05', 'Sala 3.10', 'Átrio principal']),
                'descricao' => null,
                'vagas' => $vagas,
                'inscritos' => fake()->numberBetween(0, $vagas),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}