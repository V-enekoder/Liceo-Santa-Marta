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
        Schema::create('grado_seccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')
                ->constrained('grados')
                ->cascadeOnDelete();
            $table->foreignId('seccion_id')
                ->constrained('secciones')
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
        Schema::dropIfExists('grado_seccion');
    }
};
