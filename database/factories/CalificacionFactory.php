<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calificacion;
use Faker\Generator as Faker;

/**
 * Se encarga de generar una calificación para un determinado juego, modo de uso:
 * $c = factory(App\Calificacion::class)->make(['juego_id'=>$juego->id,'descripcion'=>'Calificacion de '.$juego->nombre]);
 * donde $juego es un juego guardado en la base de datos, luego $c->save() para guardar en BD. En lugar de make se puede
 * utilizar create que automáticamente lo graba en BD.
 */
$factory->define(App\Calificacion::class, function (Faker $faker) {
    $min = App\User::orderBy('id','ASC')->first()->id;
    $max = App\User::orderBy('id','DESC')->first()->id;

    $puntaje = random_int(5,10);
    $mensaje = '';
    if($puntaje < 3){
        $mensaje = '¡Muy malo!';
    }else if($puntaje <6){
        $mensaje = 'Mediocre.';
    }else{
        $mensaje = '¡Muy bueno!';
    }

    return [
        'users_id' => App\User::all()->random()->id,
        'juego_id' => '',
        'descripcion' => '',
        'reseña' => $mensaje,
        'puntaje' => $puntaje,
        'tipo' => 'jugador',
        'created_at' => now(),
        'updated_at' => now()
    ];
});
