<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('capacity');
            $table->string('class');
            $table->string('status')->default('free');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurant_tables');
    }
};