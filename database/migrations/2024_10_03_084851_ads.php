<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->enum('position', ['header', 'sidebar', 'footer'])->default('sidebar');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('clicks')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
