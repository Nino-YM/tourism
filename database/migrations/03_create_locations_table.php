<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id('id_location');
            $table->string('location_name', 50);
            $table->text('location_description');
            $table->string('location_category', 50);
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
