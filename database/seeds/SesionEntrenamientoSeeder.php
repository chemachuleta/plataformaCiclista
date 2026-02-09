<?php

use Illuminate\Database\Seeder;

class SesionEntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sesion_entrenamiento')->insert([
            [
                'id_plan' => 1,
                'fecha' => '2026-01-03',
                'nombre' => 'Rodaje aeróbico',
                'descripcion' => 'Sesión continua',
                'completada' => 1
            ]
        ]);
    }
}
