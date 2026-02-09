<?php

use Illuminate\Database\Seeder;

class PlanEntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plan_entrenamiento')->insert([
            [
                'id_ciclista' => 1,
                'nombre' => 'Plan Base Aeróbica 2026',
                'descripcion' => 'Mejora resistencia',
                'fecha_inicio' => '2026-01-01',
                'fecha_fin' => '2026-03-31',
                'objetivo' => 'Base aeróbica',
                'activo' => 1
            ]
        ]);
    }
}

