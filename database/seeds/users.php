<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
             'email' => 'giadinh@gmail.com',
             'password' => Hash::make('123456'),
             'type' => 'hospital',
            ],
            [
             'email' => 'nhidong@gmail.com',
             'password' => Hash::make('123456'),
             'type' => 'hospital',
            ],
            [
             'email' => 'c@gmail.com',
             'password' => Hash::make('123456'),
             'type' => 'hospital',
            ],
            [
             'email' => 'quany@gmail.com',
             'password' => Hash::make('123456'),
             'type' => 'hospital',
            ]
        ]);
    }
}
