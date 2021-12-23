<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\hospital;
use App\Model;
use App\patient;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(hospital::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => "12a",
        'ward' => 'Phường Thanh Khê Tây',
        'province' => 'Quận Thanh Khê',
        'city' => 'Thành Phố Đà Nẵng',
    ];
});
