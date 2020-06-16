<?php

use Illuminate\Database\Seeder;
use App\Desarrollador;

class DesarrolladorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desarrollador::create(['nombre' => 'Square Enix']);
        Desarrollador::create(['nombre' => 'SquareSoft']);
        Desarrollador::create(['nombre' => 'Kojima Productions']);
        Desarrollador::create(['nombre' => 'Konami']);
        Desarrollador::create(['nombre' => 'Moby Dick Studio']);
        Desarrollador::create(['nombre' => 'Kojima Productions']);
        Desarrollador::create(['nombre' => 'CD Projekt Red Studio']);
        Desarrollador::create(['nombre' => 'Saber Interactive']);
        Desarrollador::create(['nombre' => 'CD Projekt RED S.A.']);
        Desarrollador::create(['nombre' => 'Nintendo']);
    }
}
