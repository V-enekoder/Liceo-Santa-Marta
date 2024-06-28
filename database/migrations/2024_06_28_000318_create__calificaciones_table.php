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
            $table->foreignId('periodo_id')->constrained('Periodos_Academicos')->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('Docentes')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained('Materias')->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained('Estudiantes')->onDelete('cascade');
            $table->integer('lapso_1')->nullable();
            $table->integer('lapso_2')->nullable();
            $table->integer('lapso_3')->nullable();
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
