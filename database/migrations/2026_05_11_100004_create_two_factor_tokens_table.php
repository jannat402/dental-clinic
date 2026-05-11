<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('two_factor_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('usuari_type', 50);      // 'administrativo' o 'doctor'
            $table->unsignedBigInteger('usuari_id');
            $table->string('codi', 6);               // Código 2FA de 6 dígitos
            $table->timestamp('expira_at');
            $table->timestamp('created_at')->useCurrent();

            $table->index(['usuari_type', 'usuari_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('two_factor_tokens');
    }
};
