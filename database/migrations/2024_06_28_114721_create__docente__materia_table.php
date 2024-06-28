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
        Schema::create('docente_materia', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('docente_id')
                ->nullable()
                ->constrained('docentes')
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
        Schema::dropIfExists('docente_materia');
    }
};
