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
        Schema::create('blog', function (Blueprint $table) {
          $table->id('id_post'); // PRIMARY KEY AUTO_INCREMENT 
          $table->string('titulo', 150); 
          $table->text('contenido'); 
          $table->dateTime('fecha_publicacion')->useCurrent(); 
          // Foreign key hacia administrativo (autor) 
          $table->unsignedBigInteger('autor_id')->nullable(); 
          $table->foreign('autor_id') ->references('id_admin') ->on('administrativo') ->onDelete('set null'); 
          // Foreign key hacia tratamiento 
          $table->unsignedBigInteger('id_tratamiento')->nullable(); 
          $table->foreign('id_tratamiento') ->references('id_tratamiento') ->on('tratamiento') ->onDelete('set null'); 
          $table->boolean('enlace_cita')->default(true); 
          $table->date('fecha_dato')->nullable(); 
          $table->timestamp('fecha_carga')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
