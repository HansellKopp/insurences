<?php

use App\Branch;
use App\Company;
use App\Client;
use App\Insurance;
use App\Receipt;
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
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'dni' => $faker->randomElement(['J','G']) . (string)$faker->numberBetween(100000000,50000000),
        'contact_name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dni' => $faker->randomElement(['V','E']) . $faker->numberBetween(100000,20000000),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address,
        'phone' => $faker->phonenumber,
        'email' => $faker->unique()->safeEmail,
    ];
});

$factory->define(App\Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Insurance::class, function (Faker $faker) {
    static $amount;
    return [
        'number' => $faker->randomNumber(8),
        'from' => $from  = $faker->date($format = 'Y-m-d', $max = '-2 year'),
        'to' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'pay_form' => $faker->randomElement(['cash','credit']),
        'amount' => $amount = $faker->numberBetween(1000000,50000000),
        'gains' => $amount * ( $faker->numberBetween(1,5) / 100 ),
        'bonus' => $faker->numberBetween(0,$amount * .20),
        'currency' => $faker->randomElement(['Bs.','$','€']),
        'company_id' => App\Company::inRandomOrder()->first()->id,
        'client_id' => App\Client::inRandomOrder()->first()->id,
        'taker_id' => App\Client::inRandomOrder()->first()->id,
        'branch_id' => App\Branch::inRandomOrder()->first()->id,
    ];
});

$factory->define(App\Receipt::class, function (Faker $faker) {
    static $amount;
    return [
        'number' => $faker->randomNumber(8),
        'from' => $faker->date($format = 'Y-m-d', $max = '-2 year'),
        'to' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'amount' => $amount = $faker->numberBetween(1000000,50000000),
        'insurance_id' => App\Insurance::inRandomOrder()->first()->id
    ];
});