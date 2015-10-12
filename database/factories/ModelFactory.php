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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Issue::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomDigitNotNull.' '.$faker->year(),
        'due' => $faker->dateTimeThisYear(),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'telephone' => $faker->phoneNumber,
        'email' => $faker->email,
        'comments' => $faker->text,
    ];
});

$factory->define(App\Adformat::class, function (Faker\Generator $faker) {
    return [
        'name' => '1/'.$faker->numberBetween(1, 3).' page',
        'price' => $faker->numberBetween(1000, 5000),
    ];
});

$factory->define(App\Advertisement::class, function (Faker\Generator $faker) {
    return [
        'comments' => $faker->text,
        'paid' => $faker->boolean(50),
    ];
});
