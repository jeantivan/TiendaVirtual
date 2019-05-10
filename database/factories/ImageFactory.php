<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
    	'product_id' => function () {
            return factory(App\Product::class)->create()->id;
        },
        'path' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
