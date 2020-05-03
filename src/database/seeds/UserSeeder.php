<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password(5, 10),
            'contact_number' => $faker->phoneNumber,
            'email_verified_at' => now(),
            'status' => 'ACTIVE',
        ]);
        /*factory(App\User::class, 3)
    ->create()
    ->each(function ($user) {
    $user->posts()->save(factory(App\Post::class)->make());
    });
     */
    }
}
