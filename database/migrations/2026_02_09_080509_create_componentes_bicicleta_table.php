<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentesBicicletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes_bicicleta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_bicicleta');
            $table->unsignedInteger('id_tipo_componente');
            $table->string('marca', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('especificacion', 50)->nullable();
            $table->enum('velocidad', ['9v','10v','11v','12v'])->nullable();
            $table->enum('posicion', ['delantera', 'trasera', 'ambas'])->nullable();
            $table->date('fecha_montaje');
            $table->date('fecha_retiro')->nullable();
            $table->decimal('km_actuales', 8, 2)->default(0);
            $table->decimal('km_max_recomendado', 8, 2)->nullable();
            $table->boolean('activo')->default(1);
            $table->string('comentario', 255)->nullable();
    
            $table->foreign('id_bicicleta')
                  ->references('id')->on('bicicleta')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
    
            $table->foreign('id_tipo_componente')
                  ->references('id')->on('tipo_componente')
                  ->onDelete('restrict')
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
        Schema::dropIfExists('componentes_bicicleta');
    }
}
