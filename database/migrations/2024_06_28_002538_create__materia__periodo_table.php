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
          Schema::create('materia_periodo', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('materia_id')
                ->nullable()
                ->constrained('materias')
                ->cascadeOnUpdate()
                ->nullOnDelete();   
            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('periodo_academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
           
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_periodo');
    }
};
