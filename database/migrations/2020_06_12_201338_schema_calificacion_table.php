<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchemaCalificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calificacion', function (Blueprint $table) {
            $table->foreign('id_juego')->references('id')->on('juego');

            $table->foreign('autor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calificacion', function (Blueprint $table) {
            //
        });
    }
}
