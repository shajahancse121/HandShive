<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->unsignedInteger('unit_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->tinyInteger('discount_type')->comment('1=parcent amount,2=flat amount')->nullable();
            $table->integer('discount')->nullable();
            $table->tinyInteger('stock')->comment('1=avaiable,0=not avaiable');
            $table->tinyInteger('new_product')->nullable()->comment('1=show ,0=not show');
            $table->tinyInteger('popular_product')->nullable()->comment('1=show ,0=not show');
            $table->tinyInteger('best_seller')->nullable()->comment('1=show ,0=not show');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->integer('weight')->nullable();
            $table->tinyInteger('status')->comment('1=publish,0=unpublish');

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
