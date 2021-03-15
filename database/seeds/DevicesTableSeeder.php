<?php

use Illuminate\Database\Seeder;
use App\Device;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Device::create([
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
            ]);
        }
    }
}
