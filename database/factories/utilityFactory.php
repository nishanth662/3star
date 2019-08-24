<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\utility;
use Faker\Generator as Faker;

$factory->define(utility::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'image' => $faker->text,
        'address' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
