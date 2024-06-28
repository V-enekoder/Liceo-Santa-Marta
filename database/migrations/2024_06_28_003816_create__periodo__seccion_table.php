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
          Schema::create('Periodo_Seccion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('seccion_id')
                ->nullable()
                ->constrained('Secciones')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Periodo_Seccion');
    }
};
