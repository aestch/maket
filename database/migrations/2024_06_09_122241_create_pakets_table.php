<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekspedisi')->references('id')->on('ekspedisis');
            $table->string('awb');
            $table->string('nama');
            $table->string('no_rak');
            $table->string('no_telepon');
            $table->enum('status', ['sudah diambil', 'belum diambil'])->default('belum diambil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
