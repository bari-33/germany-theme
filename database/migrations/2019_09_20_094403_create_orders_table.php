<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->integer('product_id');
            $table->integer('design_id');
            $table->integer('website_id');
            $table->string('total_price');
            $table->string('total_exact_price');
            $table->string('express');
            $table->enum('order_status', ['0', '1','2','3','4','-1','-2'])->default('0');
            $table->enum('payment_status', ['0', '1', '-1'])->default('0');
            $table->integer('customer_id')->unsigned();
            $table->integer('employee_chat')->nullable();
            $table->date('completion_date');
            $table->string('check_box')->default('0');
            $table->string('notification_status')->default('0');
            $table->string('empnotification_status')->default('0');
            $table->string('check_boxes')->default('0');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
