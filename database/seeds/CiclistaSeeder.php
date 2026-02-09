<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CiclistaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ciclista')->insert([
            [
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'fecha_nacimiento' => '1990-05-10',
                'peso_base' => 70.5,
                'altura_base' => 175,
                'email' => 'test1@prueba.com',
                'password' => Hash::make('prueba'),
            ],
            [
                'nombre' => 'Ana',
                'apellidos' => 'Rodríguez',
                'fecha_nacimiento' => '1992-08-20',
                'peso_base' => 60.0,
                'altura_base' => 165,
                'email' => 'test2@prueba.com',
                'password' => Hash::make('prueba'),
            ],
        ]);
    }
}
