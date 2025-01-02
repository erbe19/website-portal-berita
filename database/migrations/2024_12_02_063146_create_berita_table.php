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
        Schema::create('berita', function (Blueprint $table) {
            $table->integer(column:'id_berita')->autoIncrement();
            $table->string(column:'judul_berita');
            $table->longText(column:'isi_berita');
            $table->string(column:'gambar_berita');
            $table->integer(column:'id_kategori');
            $table->foreign(columns:'id_kategori')->references(columns:'id_kategori')->on(table:'kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
