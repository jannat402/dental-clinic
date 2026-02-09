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
        Schema::create('doctor', function (Blueprint $table) {
           $table->id('id_doctor'); // PRIMARY KEY AUTO_INCREMENT 
           $table->string('nombre', 50); 
           $table->string('apellidos', 100); 
           $table->string('especialidad', 100)->nullable(); 
           $table->date('fecha_dato')->nullable(); 
           $table->timestamp('fecha_carga')->useCurrent(); 
           $table->enum('estado', ['activo', 'vacaciones', 'baja']) ->default('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
