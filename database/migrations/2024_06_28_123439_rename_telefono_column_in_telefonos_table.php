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
        Schema::table('Telefonos', function (Blueprint $table) {
            $table->renameColumn('Telefono', 'numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Telefonos', function (Blueprint $table) {
            $table->renameColumn('numero', 'Telefono');
        });
    }
};
