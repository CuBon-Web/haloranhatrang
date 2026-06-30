<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('map_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('days')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itineraries');
    }
}
