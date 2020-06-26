<?php

use Illuminate\Database\Seeder;
use App\Juego;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Juego::all() as $juego){
            if($juego->id > 1){ //reservo el id 0 para testeo de calificaciones
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
}
