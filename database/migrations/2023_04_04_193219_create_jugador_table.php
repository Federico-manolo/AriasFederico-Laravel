<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jugador', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('nacionalidad');
            $table->integer('numero');
            $table->string('posicion');
            $table->string('foto');
            $table->unsignedBigInteger('equipo_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jugador', function (Blueprint $table) {
            $table->dropForeign(['equipo_id']); // Eliminar la FK
            $table->dropColumn('equipo_id'); // Eliminar la columna de la FK
        });
        Schema::dropIfExists('jugador');
    }
};
