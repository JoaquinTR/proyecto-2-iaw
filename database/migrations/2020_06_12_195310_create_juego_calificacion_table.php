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
            $table->string('genero');
            $table->timestamp('fecha_lanzamiento');
            $table->string('descripcion');
            $table->string('url_sitio');
            $table->string('plataforma');
            $table->timestamps();
        });

        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('autor');
            $table->unsignedBigInteger('id_juego');
            $table->string('descripcion');
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
        Schema::dropIfExists('juego');
        Schema::dropIfExists('calificacion');
    }
}
