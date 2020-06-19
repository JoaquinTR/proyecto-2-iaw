<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_vista'); //vista del juego, ej banner, principal, thumbnail, tapa de juego
            $table->unsignedBigInteger('juego_id');
            $table->longtext('imagen'); //la imágen en base64
            $table->timestamps();
        });

        Schema::table('image', function (Blueprint $table) {
            $table->foreign('juego_id')->references('id')->on('juego')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('image', function (Blueprint $table) {
        });
        Schema::dropIfExists('image');
    }
}
