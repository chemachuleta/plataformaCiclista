<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionBloqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sesion_entrenamiento');
            $table->unsignedInteger('id_bloque_entrenamiento');
            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
    
            $table->foreign('id_sesion_entrenamiento')
                  ->references('id')->on('sesion_entrenamiento')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
    
            $table->foreign('id_bloque_entrenamiento')
                  ->references('id')->on('bloque_entrenamiento')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesion_bloque');
    }
}
