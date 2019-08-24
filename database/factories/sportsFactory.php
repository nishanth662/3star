<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sports;
use Faker\Generator as Faker;

$factory->define(sports::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'image' => $faker->text,
        'location' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
