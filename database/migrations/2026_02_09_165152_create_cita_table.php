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
        Schema::create('cita', function (Blueprint $table) {
           $table->id('id_cita'); // PRIMARY KEY AUTO_INCREMENT 
           // Foreign key hacia cliente 
           $table->unsignedBigInteger('id_cliente'); 
           $table->foreign('id_cliente') ->references('id_cliente') ->on('cliente') ->onDelete('cascade'); 
           // Foreign key hacia doctor 
           $table->unsignedBigInteger('id_doctor'); 
           $table->foreign('id_doctor') ->references('id_doctor') ->on('doctor') ->onDelete('cascade'); 
           // Foreign key hacia tratamiento 
           $table->unsignedBigInteger('id_tratamiento'); 
           $table->foreign('id_tratamiento') ->references('id_tratamiento') ->on('tratamiento') ->onDelete('cascade');
           // Foreign key hacia administrativo (nullable) 
           $table->unsignedBigInteger('id_admin')->nullable(); 
           $table->foreign('id_admin') ->references('id_admin') ->on('administrativo') ->onDelete('set null'); 
           // Datos de la cita 
           $table->date('fecha'); 
           $table->time('hora_inicio'); 
           $table->time('hora_fin'); 
           $table->enum('estado', [ 'reservada', 'cancelada', 'completada', 'pendiente_pago' ])->default('pendiente_pago'); 
           $table->enum('tipo_reserva', [ 'online', 'presencial' ])->default('online'); 
           $table->date('fecha_dato')->nullable(); 
           $table->timestamp('fecha_carga')->useCurrent();
        });
         DB::statement("
            ALTER TABLE cita 
            ADD CONSTRAINT chk_cita_horas 
            CHECK (hora_fin > hora_inicio)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE cita DROP CONSTRAINT chk_cita_horas");
        Schema::dropIfExists('cita');
    }
};
