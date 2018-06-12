<?php

use Faker\Generator as Faker;

$factory->define(CodeShopping\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->streetAddress,
        'price' => $faker->numberBetween($min = 10, $max = 100),
        'slug' => 'slug'
    ];
});
