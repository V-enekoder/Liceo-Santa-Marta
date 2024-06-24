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
          Schema::create('periodo_docente', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('cedula_docente')
                ->nullable()
                ->constrained('Docentes')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('periodo_materia', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('materia_id')
                ->nullable()
                ->constrained('Materias')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('periodo_coordinador', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('coordinador_id')
                ->nullable()
                ->constrained('Coordinadores')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('periodo_grado', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id') 
                ->nullable()
                ->constrained('Periodos_Academicos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('grado_id')
                ->nullable()
                ->constrained('Grados')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('periodo_seccion', function (Blueprint $table) {
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

          Schema::create('estudiante_periodo', function (Blueprint $table) {
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

          Schema::create('estudiante_materia', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudiante_id') 
                ->nullable()
                ->constrained('Estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('materia_id')
                ->nullable()
                ->constrained('Materias')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('estudiante_seccion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudiante_id') 
                ->nullable()
                ->constrained('Estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('seccion_id')
                ->nullable()
                ->constrained('Secciones')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('estudiante_grado', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudiante_id') 
                ->nullable()
                ->constrained('Estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('grado_id')
                ->nullable()
                ->constrained('Grados')
                ->cascadeOnUpdate()
                ->nullOnDelete();              
          });

          Schema::create('estudiante_representante', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudiante_id')
                ->nullable()
                ->constrained('Estudiantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('representante_id') 
                ->nullable()
                ->constrained('Representantes')
                ->cascadeOnUpdate()
                ->nullOnDelete();          
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo_docente');
        Schema::dropIfExists('periodo_materia');
        Schema::dropIfExists('periodo_coordinador');
        Schema::dropIfExists('periodo_grado');
        Schema::dropIfExists('periodo_seccion');
        Schema::dropIfExists('estudiante_periodo');
        Schema::dropIfExists('estudiante_materia');
        Schema::dropIfExists('estudiante_seccion');
        Schema::dropIfExists('estudiante_grado');
        Schema::dropIfExists('estudiante_representante');
    }
};
