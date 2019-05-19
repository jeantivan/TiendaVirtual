<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'quantity_available' => $faker->numberBetween($min = 1, $max = 50),
        'description' => $faker->text($maxNbChars = 1000),
    ];
});
