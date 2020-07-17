<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
Use \Carbon\Carbon;

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
            $table->id();
            $table->string('invoice_no');
            $table->unsignedInteger('cupon_id')->nullable();
            $table->float('cupon_amount')->nullable();
            $table->unsignedInteger('shipping_id');
            $table->unsignedInteger('payment_type_id');
            $table->unsignedInteger('courier_id')->nullable();
            $table->string('shipping_title');
            $table->integer('shipping_amount');
            $table->integer('total_amount');
            $table->integer('total_discount_product');
            $table->integer('total_paid_amount')->default(0);
            $table->date('order_date')->default(Carbon::now());
            $table->date('delivery_date')->nullable();
            $table->tinyInteger('order_type')->comment('1=onetime order,2=registered order')->nullable();
            $table->unsignedInteger('blling_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('other_shipping_id')->nullable();
            $table->tinyInteger('order_status')->comment('1=pending,2=confirm,3=delivered,4=cancel')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
