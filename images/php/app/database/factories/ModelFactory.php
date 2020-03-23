<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Course;
use App\Session;
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
        'username' => $faker->userName,
        'password' => $faker->password,
    ];
});

$factory->define(Session::class, function (Faker $faker) {
    $created_at = $updated_at = $faker->unixTime + $faker->numberBetween(10, 10000);
    return ['created_at' => $created_at, 'updated_at' => $updated_at ];
});

$factory->define(Course::class, function (Faker $faker) {
    return ['name' => $faker->sentence(5, true)];
});

$factory->define(\App\Category::class, function (Faker $faker) {
    return [];
});

$factory->define(\App\Exercise::class, function (Faker $faker) {
    return ['name' => $faker->name, 'points' => $faker->numberBetween(0, 1000)];
});

$factory->define(\App\Score::class, function (Faker $faker) {
    $start_difficulty = $faker->numberBetween(1, 4);
    $end_difficulty = $faker->numberBetween($start_difficulty, 5);
    $score = $faker->numberBetween(0, 10000);
    $initial_normalized_score = ceil($score + ($score * ($start_difficulty / 100)));
    $normalized_score = $initial_normalized_score <= 10000 ? $initial_normalized_score : 10000;
    return [
        'score' => $score,
        'normalized_score' => $normalized_score,
        'start_difficulty' => $start_difficulty,
        'end_difficulty' => $end_difficulty
    ];
});
