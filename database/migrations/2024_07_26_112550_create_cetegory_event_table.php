<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_category')->constrained('categories', 'id_category')->onDelete('cascade');
            $table->foreignId('id_event')->constrained('events', 'id_event')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_event');
    }
};
