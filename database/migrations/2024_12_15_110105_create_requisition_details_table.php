<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id');
            $table->unsignedBigInteger('material_id');
            $table->float('quantity')->default(0);
            $table->decimal('price', 18,2)->default(0.00);
            $table->decimal('total', 18,2)->default(0.00);
            $table->string('note')->nullable();
            $table->char('status', 1)->default('a')->index();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->ipAddress('last_update_ip');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_details');
    }
}
