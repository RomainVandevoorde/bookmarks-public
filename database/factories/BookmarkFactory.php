<?php

use Faker\Generator as Faker;

$factory->define(App\Bookmark::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'url' => $faker->url,
        'description' => $faker->sentence,
        'category_id' => $faker->numberBetween(1, 20),
        'type_id' => $faker->numberBetween(1,3),
        'user_id' => $faker->numberBetween(1,4)
    ];
});
