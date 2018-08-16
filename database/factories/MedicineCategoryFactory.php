<?php

use Faker\Generator as Faker;

$factory->define(\App\MedicineCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
    ];
});
