<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunches', function (Blueprint $table) {
            $table->id();
            $table->string('lunch_time');
            $table->string('optionA_menu');
            $table->string('optionA_price');
            $table->string('optionA_image')->nullable();
            $table->string('optionB_menu');
            $table->string('optionB_price');
            $table->string('optionB_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunches');
    }
}
