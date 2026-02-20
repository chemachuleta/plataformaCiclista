<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToCiclistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('ciclista', 'remember_token')) {
            Schema::table('ciclista', function (Blueprint $table) {
                $table->rememberToken()->nullable()->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('ciclista', 'remember_token')) {
            Schema::table('ciclista', function (Blueprint $table) {
                $table->dropColumn('remember_token');
            });
        }
    }
}
