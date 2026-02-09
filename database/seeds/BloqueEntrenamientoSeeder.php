<?php

use Illuminate\Database\Seeder;

class BloqueEntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bloque_entrenamiento')->insert([
            [
                'nombre' => 'Calentamiento',
                'descripcion' => 'Rodaje suave progresivo',
                'tipo' => 'rodaje',
                'duracion_estimada' => '00:15:00',
                'potencia_pct_min' => 55,
                'potencia_pct_max' => 65,
                'pulso_pct_max' => 70,
                'pulso_reserva_pct' => 50,
                'comentario' => 'Subir pulsaciones gradualmente'
            ],
            [
                'nombre' => 'Rodaje Z2',
                'descripcion' => 'Resistencia aeróbica',
                'tipo' => 'rodaje',
                'duracion_estimada' => '01:00:00',
                'potencia_pct_min' => 65,
                'potencia_pct_max' => 75,
                'pulso_pct_max' => 80,
                'pulso_reserva_pct' => 65,
                'comentario' => 'Base aeróbica'
            ]
        ]);
    }
}

