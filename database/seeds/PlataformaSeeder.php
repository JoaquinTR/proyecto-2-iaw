<?php

use Illuminate\Database\Seeder;
use App\Plataforma;

class PlataformaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plataforma::create(['nombre' => 'Playstation']);
        Plataforma::create(['nombre' => 'Playstation 2']);
        Plataforma::create(['nombre' => 'Playstation 3']);
        Plataforma::create(['nombre' => 'Playstation 4']);
        Plataforma::create(['nombre' => 'Playstation 5']);
        Plataforma::create(['nombre' => 'Playstation Portable (PSP)']);
        Plataforma::create(['nombre' => 'Android']);
        Plataforma::create(['nombre' => 'IOS']);
        Plataforma::create(['nombre' => 'Xbox 360']);
        Plataforma::create(['nombre' => 'Xbox One']);
        Plataforma::create(['nombre' => 'PC']);
        Plataforma::create(['nombre' => 'Macintosh']);
        Plataforma::create(['nombre' => 'Wii']);
        Plataforma::create(['nombre' => 'Wii U']);
        Plataforma::create(['nombre' => 'Game Boy']);
        Plataforma::create(['nombre' => 'Game Boy Color']);
        Plataforma::create(['nombre' => 'Game Boy Advance']);
        Plataforma::create(['nombre' => 'Virtual Boy']);
        Plataforma::create(['nombre' => 'Nintendo DS']);
        Plataforma::create(['nombre' => 'Nintendo 3DS']);
        Plataforma::create(['nombre' => 'Nintendo Switch']);
    }
}
