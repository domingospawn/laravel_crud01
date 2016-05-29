<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,10) as $index) 
        {
        	User::create([
        		'name' => $faker->userName,
        		'email' => $faker->email,
        		'password' => bcrypt('secret')
        	]);
        }
    }
}
