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
            $table->unsignedBigInteger('puntaje');
            $table->unsignedBigInteger('cant_calificaciones');
            $table->timestamps();
        });

        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('juego_id');
            $table->longText('reseña');
            $table->longText('descripcion');
            $table->string('puntaje');
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
