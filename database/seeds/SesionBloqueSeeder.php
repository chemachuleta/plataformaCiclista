<?php

use Illuminate\Database\Seeder;

class SesionBloqueSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sesion_bloque')->insert([
            [
                'id_sesion_entrenamiento' => 1,
                'id_bloque_entrenamiento' => 1,
                'orden' => 1,
                'repeticiones' => 1
            ]
        ]);
    }
}
