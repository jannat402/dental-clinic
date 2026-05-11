<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditoria', function (Blueprint $table) {
            $table->id('id_auditoria');
            $table->string('usuario_type', 50)->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->string('accio', 50);
            $table->string('entitat_type', 100);
            $table->unsignedBigInteger('entitat_id');
            $table->json('valors_anteriors')->nullable();
            $table->json('valors_nous')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['usuario_type', 'usuario_id']);
            $table->index(['entitat_type', 'entitat_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditoria');
    }
};
