<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'login' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'lastactive' => time(),
        'access_level' => 0,
        'lastServer' => 1,
        'admin' => 0,
        'displayname' => $faker->name,
    ];
});

$factory->state(\App\User::class, 'admin', function (\Faker\Generator $faker) {
    return [
        'admin' => 1,
    ];
});
