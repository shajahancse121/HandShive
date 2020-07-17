<?php

use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //payment_types
        DB::table('payment_types')->insert([
            "name"=>"Cash On Delivery"
        ]);
        DB::table('payment_types')->insert([
            "name"=>"Bank"
        ]);
        DB::table('payment_types')->insert([
            "name"=>"BKash"
        ]);
        DB::table('payment_types')->insert([
            "name"=>"Rocket"
        ]);
        DB::table('payment_types')->insert([
            "name"=>"Nagad"
        ]);
        DB::table('payment_types')->insert([
            "name"=>"SureCash"
        ]);
    }
}
