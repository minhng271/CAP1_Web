<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\vaccine_patient;
use Faker\Generator as Faker;

$factory->define(vaccine_patient::class, function (Faker $faker) {
    return [
        'id_card' => '100379948665',
        'id_hos' => '166',
        'injection_times' => '1',
        'date' => '2022-04-26',
    ];
});
