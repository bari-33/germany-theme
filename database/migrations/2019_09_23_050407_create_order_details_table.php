<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->unsigned();
            $table->text('personal_description')->nullable();
            $table->string('job')->nullable();
            $table->string('job_file')->nullable();
            $table->text('job_description')->nullable();
            $table->text('qualifications')->nullable();
            $table->string('documents')->nullable();
            $table->text('motivation_description')->nullable();
            $table->string('motivation_salary')->nullable();
            $table->string('motivation_entry_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
