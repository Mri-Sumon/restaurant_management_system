<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocktailDespsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocktail_desps', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->string('cocktail_image')->nullable();
            $table->string('cocktail_video')->nullable();
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
        Schema::dropIfExists('cocktail_desps');
    }
}
