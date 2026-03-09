<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $withinTransaction = false;
    public function up(): void
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->id('id_horario'); // PRIMARY KEY AUTO_INCREMENT 
            // Foreign key manual hacia doctor 
            $table->unsignedBigInteger('id_doctor'); 
            $table->foreign('id_doctor') ->references('id_doctor') ->on('doctor') ->onDelete('cascade'); 
            $table->date('fecha');
            $table->unique(['fecha', 'id_doctor']); 
            $table->time('hora_inicio'); 
            $table->time('hora_fin'); 
            $table->boolean('disponible')->default(true); 
            $table->string('motivo_bloqueo', 255)->nullable(); 
            $table->date('fecha_dato')->nullable(); 
            $table->timestamp('fecha_carga')->useCurrent();
        });

        DB::statement(" ALTER TABLE horario 
        ADD CONSTRAINT chk_horario_horas 
        CHECK (hora_fin > hora_inicio) ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE horario DROP CONSTRAINT chk_horario_horas");
        Schema::dropIfExists('horario');
    }
};
