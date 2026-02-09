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
        Schema::create('tratamiento', function (Blueprint $table) {
           $table->id('id_tratamiento'); // PRIMARY KEY AUTO_INCREMENT 
           $table->string('nombre_tratamiento', 100); 
           $table->integer('duracion_minutos'); 
           $table->decimal('precio', 8, 2); 
           $table->date('fecha_dato')->nullable(); 
           $table->timestamp('fecha_carga')->useCurrent(); 
           $table->text('descripcion')->nullable();
        });
         DB::statement(" ALTER TABLE tratamiento 
           ADD CONSTRAINT chk_tratamiento_valores 
           CHECK (precio > 0 AND duracion_minutos > 0) ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE tratamiento DROP CONSTRAINT chk_tratamiento_valores");
        Schema::dropIfExists('tratamiento');
    }
};
