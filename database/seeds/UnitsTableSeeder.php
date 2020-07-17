<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('units')->insert([
            "name"=>"gm"
        ]);
        DB::table('units')->insert([
            "name"=>"kg"
        ]);
        DB::table('units')->insert([
            "name"=>"ml"
        ]);
        DB::table('units')->insert([
            "name"=>"ltr"
        ]);
        DB::table('units')->insert([
            "name"=>"pcs"
        ]);
    }
}
