<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title');
            $table->string('product_subtitle');
            $table->string('regular_price');
            $table->string('promotional_price')->nullable();
            $table->integer('status');
            $table->string('tax_class');
            $table->string('language');
            $table->string('product_image')->nullable();
            $table->integer('popular');
            $table->string('product_category');
            $table->text('product_description');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
