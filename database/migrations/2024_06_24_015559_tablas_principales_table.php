<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('Periodos_Academicos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->integer('Fecha_inicio')->unique();
            $table->integer('Fecha_fin')->unique();
        });

        Schema::create('Coordinadores', function (Blueprint $table) {
            $table->id();
            $table->integer('Cedula')->unique();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->string('Telefono');
            $table->string('Direccion');
            $table->string('Usuario');
            $table->string('Clave');
            $table->date('Fecha_ingreso');
            $table->date('Fecha_retiro')->nullable();
        });

        Schema::create('Docentes', function (Blueprint $table) {
            $table->id();
            $table->integer('Cedula')->unique();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->string('Telefono');
            $table->string('Direccion');
            $table->string('Usuario');
            $table->string('Clave');
        });

        Schema::create('Grados', function (Blueprint $table) {
            $table->id();
            $table->integer('Año');
        });


        Schema::create('Materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained('Grados')->onDelete('cascade');
            $table->string('Nombre');
        });

        Schema::create('Estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('Cedula')->unique();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->date('Fecha_Nacimiento');
        });

        Schema::create('Secciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained('Grados')->onDelete('cascade');
            $table->string('Nombre');
        });

        Schema::create('Calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_id')->constrained('Periodos_Academicos')->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('Docentes')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained('Materias')->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained('Estudiantes')->onDelete('cascade');
            $table->integer('lapso_1')->nullable();
            $table->integer('lapso_2')->nullable();
            $table->integer('lapso_3')->nullable();
        });

        Schema::create('Representantes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->string('Direccion');
        });

        Schema::create('Telefonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representante_id')->constrained('Representantes')->onDelete('cascade');
            $table->string('Telefono');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Periodos_Academicos');
        Schema::dropIfExists('Coordinadores');
        Schema::dropIfExists('Docentes');
        Schema::dropIfExists('Grados');
        Schema::dropIfExists('Materias');
        Schema::dropIfExists('Estudiantes');
        Schema::dropIfExists('Secciones');
        Schema::dropIfExists('Calificaciones');
        Schema::dropIfExists('Representantes');
        Schema::dropIfExists('Telefonos');
    }
};
