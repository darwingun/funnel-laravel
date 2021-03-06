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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'uuid'           => $faker->uuid,
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'phone_number'   => $faker->unique()->phoneNumber,
        'email_verified_at' => new DateTime(),
        'verified'       => true,
        'password'       => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
