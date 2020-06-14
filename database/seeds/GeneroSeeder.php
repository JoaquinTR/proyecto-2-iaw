<?php

use Illuminate\Database\Seeder;
use App\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::create(['nombre' => 'RPG']);
        Genero::create(['nombre' => 'Acción']);
        Genero::create(['nombre' => 'Aventura']);
        Genero::create(['nombre' => 'Simulación']);
        Genero::create(['nombre' => 'Deporte']);
        Genero::create(['nombre' => 'Puzzle']);
        Genero::create(['nombre' => 'Idle']);
        Genero::create(['nombre' => 'Battle Royale']);
        Genero::create(['nombre' => 'Carrera']);
        Genero::create(['nombre' => 'Combate']);
        Genero::create(['nombre' => 'Terror']);
    }
}
