<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->company,
        'address1' => $faker->address,
        'city' => $faker->city,
        'post_code' => $faker->postcode,
        'postal_address1' => $faker->address,
        'postal_city' => $faker->city,
        'postal_post_code' => $faker->postcode,
    ];
});
