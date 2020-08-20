<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'title' => $faker->title,
        'slug' => str::slug($faker->title),
        'about' => $faker->paragraph,
        'view' => $faker->numberBetween(100, 10000),
    ];
});
