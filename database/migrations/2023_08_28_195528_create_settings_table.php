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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('site_title');
            $table->text('description');
            $table->text('keywords');
            $table->string('author');
            $table->string('linkedin');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
