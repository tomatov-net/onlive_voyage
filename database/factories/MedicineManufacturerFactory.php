<?php

use Faker\Generator as Faker;

$factory->define(\App\MedicineManufacturer::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'description' => $faker->unique()->text,
    ];
});
