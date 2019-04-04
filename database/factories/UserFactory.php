<?php

use App\Model\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('12345'),
        'avatar' => 'https://i.pinimg.com/236x/8b/02/d4/8b02d4b04ef1acc46f3390641204ee21--todoroki-chibi-boku-no-hero-academia-todoroki.jpg?b=t',
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Model\Message::class, function (Faker $faker) {
    do {
        $from = rand(1, 10);
        $to = rand(1, 10);
    } while ($from == $to);

    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence
    ];
});
