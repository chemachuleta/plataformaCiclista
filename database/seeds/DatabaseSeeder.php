<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call('CiclistaSeeder');
        $this->call('TipoComponenteSeeder');
        $this->call('BicicletaSeeder');
        $this->call('BloqueEntrenamientoSeeder');
        $this->call('PlanEntrenamientoSeeder');
        $this->call('SesionEntrenamientoSeeder');
        $this->call('SesionBloqueSeeder');
        $this->call('EntrenamientoSeeder');
    }
}
