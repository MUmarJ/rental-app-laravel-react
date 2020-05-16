<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('posts')->insert([
            'title' => $faker->name,
            'description' => $faker->sentence,
            'post_status' => 'ACTIVE',
            'category_id' => $faker->randomElement([1, 2]),
        ]);
    }
}
