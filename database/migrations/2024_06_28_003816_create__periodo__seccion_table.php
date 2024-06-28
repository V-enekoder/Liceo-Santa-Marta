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
          Schema::create('periodo_seccion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('periodo_academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('seccion_id')
                ->nullable()
                ->constrained('secciones')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo_seccion');
    }
};
