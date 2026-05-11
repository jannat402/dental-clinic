<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Eliminar l'índex únic antic si existeix (pot tenir noms diferents)
        $indexes = DB::select("SHOW INDEX FROM horario WHERE Key_name LIKE '%fecha%' AND Key_name LIKE '%doctor%' AND Non_unique = 0");
        foreach ($indexes as $index) {
            DB::statement("ALTER TABLE horario DROP INDEX `{$index->Key_name}`");
        }

        Schema::table('horario', function (Blueprint $table) {
            $table->unique(['fecha', 'id_doctor', 'hora_inicio'], 'horario_fecha_doctor_hora_unique');
            $table->enum('tipus_bloqueig', ['vacaciones', 'tancament', 'mantenimiento'])->nullable()->after('motivo_bloqueo');
        });
    }

    public function down(): void
    {
        Schema::table('horario', function (Blueprint $table) {
            $table->dropUnique('horario_fecha_doctor_hora_unique');
            $table->unique(['fecha', 'id_doctor']);
            $table->dropColumn('tipus_bloqueig');
        });
    }
};
