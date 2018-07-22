<?php

use Faker\Generator as Faker;

$factory->define(App\AdminAccount::class, function (Faker $faker) {
    return [
        //
        'user_name' => $faker->unique()->firstName,
        'admin_type' => $faker->randomElement($array = array ('admin','super')),
        'password' => bcrypt('123456'), // secret
    ];
});
