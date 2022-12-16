<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interaccions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_perro_interesado')->nullable();
            $table->unsignedBigInteger('id_perro_candidato')->nullable();
            $table->foreign('id_perro_interesado')->references('id')->on('perros');
            $table->foreign('id_perro_candidato')->references('id')->on('perros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interaccions', function (Blueprint $table) {
            $table->dropForeign('id_perro_interesado');
            $table->dropForeign('id_perro_candidato');
        });
    }
};
