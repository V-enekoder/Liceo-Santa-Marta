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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_materia_id')
                ->constrained('docente_materia')
                ->cascadeOnDelete();
            $table->foreignId('estudiante_materia_id')
                ->constrained('estudiante_materia')
                ->cascadeOnDelete();
            $table->unsignedInteger('lapso_1')->default(0);
            $table->unsignedInteger('lapso_2')->default(0);
            $table->unsignedInteger('lapso_3')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
