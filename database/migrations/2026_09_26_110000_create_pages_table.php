<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin panelinden "Kurumsal" menüsü altına eklenebilen serbest
     * içerikli sayfalar (Hakkımızda gibi ama sınırsız sayıda). Her sayfa
     * otomatik olarak sitedeki Kurumsal menüsünde (masaüstü + mobil)
     * görünür.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
