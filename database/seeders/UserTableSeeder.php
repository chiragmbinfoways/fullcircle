<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $action=[
            [
                'username' => 'sup_admin',
                'name' => 'Jaykishan Patel',
                'avatar' => '',
                'email'=>'myemail@mail.com',
                'phone'=>'9909999099',
                'password'=>'$2y$10$bYMtYeU.T9ZRuah4mVdngOw8j9NyU7CV6EX86zBzFF71SDZGbGPhS', //123456
                'status'=>'1',
            ]
        ];
            DB::table('users')->insert($action);
    }
}
