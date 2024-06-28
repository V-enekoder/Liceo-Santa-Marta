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
          Schema::create('Estudiante_Periodo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudiante_id') 
                ->nullable()
                ->constrained('Estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('periodo_id')
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Estudiante_Periodo');
    }
};
