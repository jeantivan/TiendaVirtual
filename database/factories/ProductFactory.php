<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000000),
        'description' => $faker->text($maxNbChars = 190),
    ];
});
