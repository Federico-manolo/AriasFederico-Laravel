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
        Schema::create('cartas_en_pedido', function (Blueprint $table) {
            $table->id();
            $table->string('cant_producto');
            $table->unsignedBigInteger('carta_id');
            $table->unsignedBigInteger('pedido_id');
            $table->timestamps();
            $table->softDeletes();    
            $table->foreign('carta_id')->references('id')->on('carta');
            $table->foreign('pedido_id')->references('id')->on('pedido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartas_en_pedido', function (Blueprint $table) {
            $table->dropForeign(['carta_id']); // Eliminar la FK
            $table->dropForeign(['pedido_id']); // Eliminar la FK
            $table->dropColumn('carta_id'); // Eliminar la columna de la FK
            $table->dropColumn('pedido_id'); // Eliminar la columna de la FK
        });
        Schema::dropIfExists('cartas_en_pedido');
    }
};
