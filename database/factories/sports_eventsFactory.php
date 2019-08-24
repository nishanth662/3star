<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sports_events;
use Faker\Generator as Faker;

$factory->define(sports_events::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'ground' => $faker->text,
        'date' => $faker->text,
        'time' => $faker->text,
        'price' => $faker->text,
        'image' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
