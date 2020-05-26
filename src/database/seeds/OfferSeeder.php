<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('offers')->insert([
            'post_id' => $faker->randomElement([1, 2]),
            'customer_id' => $faker->randomElement([1, 2]),
            'status' => $faker->randomElement(
                ['OPEN', 'COMPLETED', 'CLOSED']
            ),
        ]);
    }
}
