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

            $table->foreignId('estudiante_id') 
                ->nullable()
                ->constrained('estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('materia_id')
                ->nullable()
                ->constrained('materias')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
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
