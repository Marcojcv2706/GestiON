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
        Schema::create('sub_espacios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Clave foránea para la relación Espacio 1:N SubEspacio
            $table->foreignId('espacio_id')->constrained('espacios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_espacios');
    }
};