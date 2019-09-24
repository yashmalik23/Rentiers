<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            "email" => "inforentiers@gmail.com",
            "contact" => "0000000000",
            "password" => Hash::make('admin_password'),
            "remember_token" => str_random(10),
            "member" => "Member",
        ]);
    }
}
