<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id('id_mensaje');
            $table->string('remitente_type', 50);
            $table->unsignedBigInteger('remitente_id');
            $table->string('destinatario_type', 50);
            $table->unsignedBigInteger('destinatario_id');
            $table->string('asunto', 200)->nullable();
            $table->text('cuerpo');
            $table->boolean('leido')->default(false);
            $table->timestamp('created_at')->useCurrent();

            $table->index(['remitente_type', 'remitente_id']);
            $table->index(['destinatario_type', 'destinatario_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
