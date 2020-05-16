<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('notifications')->insert([
            'post_id' => $faker->randomElement([1, 2]),
            'user_id' => $faker->randomElement([1, 2]),
            'request_id' => $faker->randomElement([1, 2]),
            'title' => $faker->name,
            'description' => $faker->sentence,
            'seen' => $faker->randomElement([true, false]),
        ]);
    }
}
