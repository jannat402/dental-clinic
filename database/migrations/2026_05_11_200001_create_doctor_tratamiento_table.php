<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_tratamiento', function (Blueprint $table) {
            $table->id('id_doctor_tratamiento');
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_tratamiento');
            $table->unique(['id_doctor', 'id_tratamiento'], 'doctor_tratamiento_unique');

            $table->foreign('id_doctor')->references('id_doctor')->on('doctor')->onDelete('cascade');
            $table->foreign('id_tratamiento')->references('id_tratamiento')->on('tratamiento')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_tratamiento');
    }
};
