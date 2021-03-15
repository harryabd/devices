<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Device;
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

$factory->define(Device::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'address' => $faker->address,
        'longitude' => $faker->randomFloat(7, -999, 999),
        'latitude' => $faker->randomFloat(7, -999, 999),
        'device_type' => $faker->text(10),
        'manufacturer' => $faker->word,
        'model' => $faker->word,
        'install_date' => $faker->dateTime,
        'notes' => $faker->paragraph,
        'eui' => $faker->uuid,
        'serial_number' => $faker->randomNumber,
        'upload_id' => $faker->randomNumber
    ];
});
