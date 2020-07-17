<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name"=>"Admin",
            "email"=>"admin@gmail.com",
            "role_id"=>1,
            "password"=>bcrypt('12345678'),
            "status"=>1,
            "image"=>"blank.png"
        ]);
        DB::table('users')->insert([
            "name"=>"Employee",
            "email"=>"employee@gmail.com",
            "role_id"=>2,
            "password"=>bcrypt('12345678'),
            "status"=>1,
            "image"=>"blank.png"
        ]);
    }
}
