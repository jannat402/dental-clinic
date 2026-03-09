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
        Schema::create('cliente', function (Blueprint $table) {
           $table->id('id_cliente'); 
           $table->string('nombre', 50); 
           $table->string('apellidos', 100); 
           $table->string('telefono', 20)->nullable(); 
           $table->string('email', 100)->nullable();
           $table->string('contrasenya'); 
           $table->enum('metodo_autenticacion', ['telefono', 'email']); 
           $table->date('fecha_dato')->nullable(); 
           $table->timestamp('fecha_carga')->useCurrent();
        });
        DB::statement("
                ALTER TABLE cliente 
                ADD CONSTRAINT chk_contacto_cliente 
                CHECK (telefono IS NOT NULL OR email IS NOT NULL)
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE cliente DROP CONSTRAINT chk_contacto_cliente");
        Schema::dropIfExists('cliente');
    }
};
