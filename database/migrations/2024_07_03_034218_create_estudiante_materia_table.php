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
        Schema::create('estudiante_materia', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estudiante_cedula');
            $table->foreign('estudiante_cedula')
                ->references('cedula')
                ->on('estudiantes');
            $table->foreignId('materia_id')
                ->constrained('materias')
                ->cascadeOnDelete();
            $table->foreignId('periodo_id')
                ->constrained('periodos_academicos')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_materia');
    }
};
