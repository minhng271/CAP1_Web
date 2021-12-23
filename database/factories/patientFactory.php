<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\patient;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(patient::class, function (Faker $faker) {
    return [
        'id_card' => random_int(100000000000,999999999999),
        'fullname' => $faker->firstName." ".$faker->lastName,
        'birthDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => 'male',
        'health_card' => random_int(100000000000,999999999999),
        'phone' => random_int(1000000000,9999999999),
        'email' => $faker->unique()->safeEmail,
        'job' => $faker->jobTitle,
        'address' => '12a',
        'ward' => 'Phường Thanh Khê Tây',
        'district' => 'Quận Thanh Khê',
        'city' => 'Thành Phố Đà Nẵng',
        'country' => 'Việt Nam',
        'nation' => 'Kinh',
        'password' => Hash::make('Tuan123123'),
    ];
});
