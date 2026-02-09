<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $withinTransaction = false;
    public function up(): void
    {
        Schema::create('doctor_historial', function (Blueprint $table) {
            $table->id('id_doctor_historial'); // PRIMARY KEY AUTO_INCREMENT 
            // Foreign key hacia doctor 
            $table->unsignedBigInteger('id_doctor'); 
            $table->foreign('id_doctor') ->references('id_doctor') ->on('doctor') ->onDelete('cascade'); 
            // Foreign key hacia historial_clinico 
            $table->unsignedBigInteger('id_historial'); 
            $table->foreign('id_historial') ->references('id_historial') ->on('historial_clinico') ->onDelete('cascade'); 
            $table->date('fecha_asignacion')->useCurrent(); 
            $table->date('fecha_dato')->nullable(); 
            $table->timestamp('fecha_carga')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_historial');
    }
};
