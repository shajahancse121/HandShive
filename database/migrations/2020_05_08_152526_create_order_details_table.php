<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
Use \Carbon\Carbon;
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
            $table->id();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('weight');
            $table->unsignedInteger('unit_id');
            $table->date('order_date')->default(Carbon::now());
            $table->tinyInteger('order_status')->comment('1=pending,2=confirm,2=delivered')->nullable();
            $table->tinyInteger('order_type')->comment('1=onetime order,2=registered order')->nullable();
            $table->integer('sales_rate');
            $table->integer('discount_amount')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
