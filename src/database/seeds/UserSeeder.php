<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_US');
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => Str::random(12) . '@gmail.com',
            'password' => Hash::make('password'),
            'contact_number' => $faker->phoneNumber,
            'email_verified_at' => now(),
            'status' => 'ACTIVE',
            'images' => 0,
        ]);
        /*factory(App\User::class, 3)
    ->create()
    ->each(function ($user) {
    $user->posts()->save(factory(App\Post::class)->make());
    });
     */
    }
}
