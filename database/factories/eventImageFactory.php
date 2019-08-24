<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\eventImage;
use Faker\Generator as Faker;

$factory->define(eventImage::class, function (Faker $faker) {

    return [
        'event_id' => $faker->text,
        'image' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
