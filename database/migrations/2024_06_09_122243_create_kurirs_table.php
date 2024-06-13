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
        Schema::create('kurirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekspedisi_id')->references('id')->on('ekspedisis');
            $table->string('nama');
            $table->string('password');
            // $table->string('api_key')->default('3cb0c44123732816829630ba6928e87716faf01009799dd62b5aa78608fd653d');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurirs');
    }

};
