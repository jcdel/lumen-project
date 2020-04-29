<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Post;
use App\Entities\User;
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

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'text' => $faker->text(3000),
        'image' => $faker->imageUrl($width = 1900, $height = 840),
        'user_id' => User::all()->random()->id
    ];
});
