<?php

use Faker\Generator as Faker;
use Market\Models\Offer;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber(),
        'price' => $faker->randomNumber(5),
        'amount' => $faker->randomNumber(2),
        'sales' => $faker->randomNumber(3),
        'article' => $faker->slug,
    ];
});
