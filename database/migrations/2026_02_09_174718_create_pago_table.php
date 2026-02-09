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
        Schema::create('pago', function (Blueprint $table) {
          $table->id('id_pago'); // PRIMARY KEY AUTO_INCREMENT 
          // Foreign key hacia cita 
          $table->unsignedBigInteger('id_cita'); 
          $table->foreign('id_cita') ->references('id_cita') ->on('cita') ->onDelete('cascade'); 
          $table->decimal('monto', 8, 2); 
          $table->enum('metodo_pago', ['tarjeta', 'efectivo', 'transferencia']); 
          $table->enum('estado_pago', ['pendiente', 'pagado', 'fallido']) ->default('pendiente'); 
          $table->dateTime('fecha_pago')->nullable(); 
          $table->date('fecha_dato')->nullable(); 
          $table->timestamp('fecha_carga')->useCurrent();
        });
        DB::statement("
            ALTER TABLE pago 
            ADD CONSTRAINT chk_pago_monto 
            CHECK (monto > 0)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pago DROP CONSTRAINT chk_pago_monto");
        Schema::dropIfExists('pago');
    }
};
