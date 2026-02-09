<?php

use Illuminate\Database\Seeder;

class BicicletaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bicicleta')->insert([
            ['nombre' => 'Tacx NEO2', 'tipo' => 'rodillo', 'comentario' => 'Rodillo inteligente'],
            ['nombre' => 'Stevens A', 'tipo' => 'carretera', 'comentario' => 'Carretera entrenamiento'],
            ['nombre' => 'Stevens B', 'tipo' => 'carretera', 'comentario' => 'Carretera competición'],
            ['nombre' => 'Kuota', 'tipo' => 'carretera', 'comentario' => 'Carretera ligera'],
            ['nombre' => 'MTB', 'tipo' => 'mtb', 'comentario' => 'Mountain bike estándar'],
            ['nombre' => 'MTB Electrica', 'tipo' => 'mtb', 'comentario' => 'Mountain bike eléctrica'],
        ]);
    }
}

