<?php

use Illuminate\Database\Seeder;

class EntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('entrenamiento')->insert([
            [
                'id_ciclista' => 1,
                'id_bicicleta' => 1,
                'fecha' => '2026-01-01 07:30:00',
                'duracion' => '01:45:00',
                'kilometros' => 55.2,
                'recorrido' => 'Ruta Valle',
                'pulso_medio' => 140,
                'pulso_max' => 170,
                'potencia_media' => 200,
                'potencia_normalizada' => 210,
                'velocidad_media' => 31.5,
                'puntos_estres_tss' => 60.5,
                'factor_intensidad_if' => 0.88,
                'ascenso_metros' => 800,
                'comentario' => 'Buen ritmo'
            ]
        ]);
    }
}
