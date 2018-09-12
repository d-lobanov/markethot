<?php

use Faker\Generator as Faker;
use Market\Models\Offer;
use Market\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber(),
        'title' => $faker->sentence($faker->numberBetween(1, 10)),
        'image' => $faker->imageUrl(320, 240),
        'description' => $faker->paragraph,
        'first_invoice' => $faker->date('Y-m-d H:i:s'),
        'url' => $faker->url,
        'price' => $faker->randomNumber(5),
        'amount' => $faker->randomNumber(2),
        'offers' => factory(Offer::class, $faker->numberBetween(0, 10))->make(),
    ];
});
