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
            $table->string('imagen');
            $table->longText('genero');
            $table->timestamp('fecha_lanzamiento');
            $table->longText('descripcion');
            $table->longText('plataforma');
            $table->longText('editor');
            $table->longText('desarrollador');
            $table->timestamps();
        });

        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('autor');
            $table->unsignedBigInteger('id_juego');
            $table->longText('reseña');
            $table->longText('descripcion');
            $table->string('puntaje');
            $table->string('tipo');
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
