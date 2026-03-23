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
        Schema::create('administrativo', function (Blueprint $table) {
          $table->id('id_admin'); // PRIMARY KEY AUTO_INCREMENT 
          $table->string('nombre', 50); 
          $table->string('apellidos', 100); 
          $table->string('email', 100)->unique();
          $table->string('contrasenya'); 
          $table->enum('autenticacion_segura', ['2FA', 'certificado']); 
          $table->date('fecha_dato')->nullable(); 
          $table->timestamp('fecha_carga')->useCurrent(); 
          $table->string('rol', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrativo');
    }
};
