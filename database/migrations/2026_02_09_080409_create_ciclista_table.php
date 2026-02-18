<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclista', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 80);
            $table->string('apellidos', 80);
            $table->date('fecha_nacimiento');
            $table->decimal('peso_base', 5, 2)->nullable();
            $table->integer('altura_base')->nullable();
            $table->string('email', 80);
            $table->string('password', 255);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciclista');
    }
}
