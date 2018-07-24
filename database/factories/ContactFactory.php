<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        //
        'title_id' => $faker->numberBetween($min = 0, $max = 6),
        'role' => $faker->firstName,
        'name' => $faker->name,
        'customer_id' => $faker->numberBetween($min = 1, $max = 10),
        'location' => $faker->address,
        'phone_work' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});
