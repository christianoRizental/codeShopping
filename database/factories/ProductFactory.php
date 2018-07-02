<?php

use Faker\Generator as Faker;

$factory->define(CodeShopping\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        //'description' => $faker->streetAddress,
        'description' => $faker->text(400),
        //'price' => $faker->numberBetween($min = 10, $max = 100),
        'price' => $faker->randomFloat(2, 100, 1000),
        'slug' => 'slug'
    ];
});
