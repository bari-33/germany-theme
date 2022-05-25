<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('username');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('telephone')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            $table->string('biographical_information')->nullable();
            $table->integer('deutch')->nullable();
            $table->integer('english')->nullable();
            $table->integer('spanish')->nullable();
            $table->integer('french')->nullable();
            $table->integer('web_designer')->nullable();
            $table->integer('graphic_designer')->nullable();
            $table->integer('media_designer')->nullable();
            $table->string('company')->nullable();
            $table->string('street_no')->nullable();
            $table->string('house_no')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('bc')->nullable();
            $table->string('paypal')->nullable();

            $table->integer('billing')->nullable();
            $table->integer('amount')->nullable();

            $table->foreign('user_id')->references('id')->on('users')

                ->onDelete('cascade');

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
        Schema::dropIfExists('user_details');
    }
}
