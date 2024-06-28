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
        Schema::create('Estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('Cedula')->unique();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->date('Fecha_Nacimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Estudiantes');
    }
};
