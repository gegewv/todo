<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        // 在命令行中运行
        /*
         * php artisan tinker
         * factory(App\Todo::class, 5)->create()
         */
    ];
});
