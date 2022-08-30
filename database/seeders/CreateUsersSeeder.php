<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@demo.com',
                'is_admin'=>'1',
                'is_shopowner'=>'0',
                'is_seller'=>'0',
                'is_user'=>'0',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Owner',
                'email'=>'owner@demo.com',
                'is_admin'=>'0',
                'is_shopowner'=>'1',
                'is_seller'=>'0',
                'is_user'=>'0',
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Seller',
                'email'=>'seller@demo.com',
                'is_admin'=>'0',
                'is_shopowner'=>'0',
                'is_seller'=>'1',
                'is_user'=>'0',
                'password'=> bcrypt('123456'),
             ],
             [
                'name'=>'User',
                'email'=>'user@demo.com',
                'is_admin'=>'0',
                'is_shopowner'=>'0',
                'is_seller'=>'0',
                'is_user'=>'1',
                'password'=> bcrypt('123456'),
             ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
