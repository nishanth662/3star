<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sportsImage;
use Faker\Generator as Faker;

$factory->define(sportsImage::class, function (Faker $faker) {

    return [
        'sports_id' => $faker->text,
        'image' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
