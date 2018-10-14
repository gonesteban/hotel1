<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned();
            $table->integer('id_habitacion')->unsigned();
            $table->integer('num_personas');
            $table->integer('costo')->default('0');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida');
            $table->integer('estado');

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_habitacion')->references('id')->on('habitacion')->onDelete('cascade');



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
        Schema::dropIfExists('reserva');
    }
}
