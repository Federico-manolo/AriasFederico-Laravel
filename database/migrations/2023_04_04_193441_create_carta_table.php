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
        Schema::create('carta', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('costo');
            $table->integer('estadistica');
            $table->string('categoria');
            $table->unsignedBigInteger('jugador_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('jugador_id')->references('id')->on('jugador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carta', function (Blueprint $table) {
            $table->dropForeign(['jugador_id']); // Eliminar la FK
            $table->dropColumn('jugador_id'); // Eliminar la columna de la FK
        });
        Schema::dropIfExists('carta');
    }
};
