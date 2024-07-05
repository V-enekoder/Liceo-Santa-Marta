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
        Schema::create('estudiante_representante', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estudiante_cedula');
            $table->foreign('estudiante_cedula')
                ->references('cedula')
                ->on('estudiantes')
                ->onDelete('cascade'); 
            $table->foreignId('representante_id')
                ->constrained('representantes')
                ->onDelete('cascade'); 
            $table->foreignId('periodo_id')
                ->constrained('periodos_academicos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_representante');
    }
};
