<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            JuegoSeeder::class,
            CalificacionSeeder::class,
            GeneroSeeder::class,
            PlataformaSeeder::class,
            EditorSeeder::class,
            DesarrolladorSeeder::class,
            ImageSeeder::class
        ]);
    }
}
