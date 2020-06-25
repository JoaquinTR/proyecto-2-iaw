<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuegoCalificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juego', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->longText('genero');
            $table->date('fecha_lanzamiento');
            $table->longText('descripcion');
            $table->longText('plataforma');
            $table->longText('editor');
            $table->longText('desarrollador');
            $table->unsignedBigInteger('puntaje')->default(0);
            $table->unsignedBigInteger('cant_calificaciones')->default(0);
            $table->float('rating', 2, 2)->default(0); //entre 0,00 y 10,00
            $table->timestamps();
        });

        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('juego_id');
            $table->longText('reseña');
            $table->longText('descripcion');
            $table->unsignedBigInteger('puntaje');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion');
        Schema::dropIfExists('juego');
    }
}
