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
    return [
        'name' => 'Suber Admin',
        'email' => 'admin@admin.com',
        'photo' => 'images/user-avatar/default-avatar.png',
        'email_verified_at' => now(),
        'password' => bcrypt(123456), // 123456
        'remember_token' => str_random(40),
        'rule' => 1,
        'active' => 1
    ];
    // return [
    //     'name' => $faker->name,
    //     'email' => $faker->unique()->safeEmail,
    //     'image' => 'images/user-avatar/default-avatar.png',
    //     'email_verified_at' => now(),
    //     'password' => bcrypt(123456), // 123456
    //     'remember_token' => str_random(40),
    // ];
});
