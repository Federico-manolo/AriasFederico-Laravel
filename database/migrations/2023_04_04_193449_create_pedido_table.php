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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->dateTime('fecha_pedido');
            $table->dateTime('fecha_entrega');
            $table->integer('monto_total');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();    
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Eliminar la FK
            $table->dropColumn('user_id'); // Eliminar la columna de la FK
        });
        Schema::dropIfExists('pedido');
    }
};
