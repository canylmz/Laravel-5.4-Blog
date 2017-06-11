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


$factory->define(App\Post::class, function (Faker $faker) {

    return [
        //
        'author_id' =>rand(1,20),
        'title' =>$title=$faker->unique()->sentence(),
        'body' =>$faker->paragraph,
        'slug'=>str_slug($title),
        'created_at'=>$date=$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = date_default_timezone_get()),
        'updated_at'=>$date
    ];
});
