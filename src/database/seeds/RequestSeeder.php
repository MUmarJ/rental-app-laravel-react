<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('requests')->insert([
            'post_id' => $faker->randomElement([1, 2]),
            'user_id' => $faker->randomElement([1, 2]),
            'status' => $faker->randomElement(
                ['OPEN', 'COMPLETED', 'CANCELED']
            ),
        ]);
    }
}
