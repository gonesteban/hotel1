<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hotel')->unsigned();
            $table->string('tipo_habitacion');
            $table->integer('capacidad');
            $table->integer('precio');
            $table->integer('cantidad');
            $table->integer('valor_oferta');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('estado');


            $table->foreign('id_hotel')->references('id')->on('hotel')->onDelete('cascade');

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
        Schema::dropIfExists('habitacion');
    }
}
