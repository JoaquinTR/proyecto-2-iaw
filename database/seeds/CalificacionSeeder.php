<?php

use Illuminate\Database\Seeder;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(App\Juego::all() as $juego){
            foreach(range(0,20) as $i){
                $calif = factory(App\Calificacion::class)->make(['juego_id'=>$juego->id,'descripcion'=>'Calificacion de '.$juego->nombre]);
                $juego->puntaje = $juego->puntaje + $calif->puntaje;
                $juego->cant_calificaciones = $juego->cant_calificaciones + 1;
                $juego->rating = $juego->puntaje / $juego->cant_calificaciones;
                $juego->save();
                $calif->juego_id = $juego->id;
                $calif->save();
            }
        }
    }
}
