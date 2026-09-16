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
        Schema::create('referanslar', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('kategori');
            $table->string('konum');
            $table->string('yazilim');
            $table->string('tarih');
            $table->string('musteri');
            $table->string('content');
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referanslar');
    }
};
