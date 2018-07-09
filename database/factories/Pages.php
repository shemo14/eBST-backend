<?php

use Faker\Generator as Faker;

$factory->define(\App\Page::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content'   => $faker->randomHtml(8,10),
    ];
});
