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
        Schema::create('historial_clinico', function (Blueprint $table) {
           $table->id('id_historial'); // PRIMARY KEY AUTO_INCREMENT 
           // Foreign key manual hacia cliente 
           $table->unsignedBigInteger('id_cliente'); 
           $table->foreign('id_cliente') ->references('id_cliente') ->on('cliente') ->onDelete('cascade'); 
           $table->text('notas_diagnostico')->nullable(); 
           $table->string('documentos_adjuntos', 255)->nullable(); 
           $table->dateTime('fecha_ultima_actualizacion')->useCurrent(); 
           $table->date('fecha_dato')->nullable(); 
           $table->timestamp('fecha_carga')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinico');
    }
};
