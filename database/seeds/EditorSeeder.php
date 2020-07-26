<?php

use Illuminate\Database\Seeder;
use App\Editor;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Editor::create(['nombre' => 'Square Enix']);
        Editor::create(['nombre' => 'SquareSoft']);
        Editor::create(['nombre' => 'Square EA']);
        Editor::create(['nombre' => 'Konami']);
        Editor::create(['nombre' => 'Warner Bros. Interactive Entertainment']);
        Editor::create(['nombre' => 'CD Projekt RED S.A.']);
        Editor::create(['nombre' => 'CD Projekt Red Studio']);
        Editor::create(['nombre' => 'Spike Chunsof']);
        Editor::create(['nombre' => 'Bandai Namco Games']);
        Editor::create(['nombre' => 'Nintendo']);
    }
}
