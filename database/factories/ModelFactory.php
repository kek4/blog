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

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->title(),
        'description' => $faker->text(200),
        'short_description' => $faker->text(100),
        'nbers' => $faker->randomDigitNotNull(),
        'bake_time' => $faker->randomDigitNotNull(),
        'prep_time' => $faker->randomDigitNotNull(),
        'available' => $faker->boolean(50),
    ];
});
