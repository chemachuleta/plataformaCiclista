<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_ciclista');
            $table->unsignedInteger('id_bicicleta');
            $table->unsignedInteger('id_sesion')->nullable();
            $table->dateTime('fecha');
            $table->time('duracion');
            $table->decimal('kilometros', 6, 2);
            $table->string('recorrido', 150);
            $table->integer('pulso_medio')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('potencia_media')->nullable();
            $table->integer('potencia_normalizada');
            $table->decimal('velocidad_media', 5, 2);
            $table->decimal('puntos_estres_tss', 6, 2)->nullable();
            $table->decimal('factor_intensidad_if', 4, 3)->nullable();
            $table->integer('ascenso_metros')->nullable();
            $table->string('comentario', 255)->nullable();
    
            $table->foreign('id_ciclista')
                  ->references('id')->on('ciclista')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
    
            $table->foreign('id_bicicleta')
                  ->references('id')->on('bicicleta')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
    
            $table->foreign('id_sesion')
                  ->references('id')->on('sesion_entrenamiento')
                  ->onDelete('set null')
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
        Schema::dropIfExists('entrenamiento');
    }
}
