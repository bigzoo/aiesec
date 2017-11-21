<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
        'title' => $faker->jobTitle,
        'image' => $faker->image('public/images/profileImages',400,300, null, false) ,
        'year-start' => $faker->numberBetween($min = 1980, $max = 2017),
        'year-end' => $faker->numberBetween($min = 1980, $max = 2017),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
