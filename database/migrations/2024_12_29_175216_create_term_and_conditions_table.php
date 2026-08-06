<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermAndConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_and_conditions', function (Blueprint $table) {
            $table->id();
            $table->text('booking')->nullable();
            $table->text('cancellation')->nullable();
            $table->text('request_booking')->nullable();
            $table->text('dining')->nullable();
            $table->text('allergens')->nullable();
            $table->text('dress_code')->nullable();
            $table->text('cakes')->nullable();
            $table->text('decorations')->nullable();
            $table->text('child')->nullable();
            $table->text('dog')->nullable();
            $table->text('gift')->nullable();
            $table->text('accessibility')->nullable();
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
        Schema::dropIfExists('term_and_conditions');
    }
}
