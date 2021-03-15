<?php

use Illuminate\Database\Seeder;
use App\Upload;

class UploadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Upload::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Upload::create([
                'filepath' => $faker->word . '.csv',
            ]);
        }
    }
}
