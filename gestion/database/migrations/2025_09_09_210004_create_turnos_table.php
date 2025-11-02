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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');

            // Claves foráneas para las relaciones del turno
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('recurso_id')->nullable()->constrained('recursos')->onDelete('set null');
            $table->foreignId('espacio_id')->nullable()->constrained('espacios')->onDelete('set null');
            $table->foreignId('sub_espacio_id')->nullable()->constrained('sub_espacios')->onDelete('set null');
            $table->foreignId('actividad_id')->nullable()->constrained('actividades')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};