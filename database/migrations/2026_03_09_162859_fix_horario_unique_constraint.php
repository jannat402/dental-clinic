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
        Schema::table('horario', function (Blueprint $table) {
            // dropUnique accepts column names array; the previous attempt used the index name which may not exist
            $table->dropUnique(['fecha', 'id_doctor']); // Drop the existing unique constraint on fecha+id_doctor
            $table->unique(['fecha', 'id_doctor']); // Recreate correct composite unique (no-op if already removed)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horario', function (Blueprint $table) {
            $table->dropUnique(['fecha', 'id_doctor']);
            // If rolling back we don't really need to recreate the faulty unique, but leave commented as reference
            // $table->unique('fecha', 'id_doctor');
        });
    }
};
