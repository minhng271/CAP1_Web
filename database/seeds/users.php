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
             'email' => 'admin',
             'password' => Hash::make('123456'),
             'type' => 'admin',
            ]
        ]);
    }
}
