<?php

use Illuminate\Database\Seeder;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class {{class}} extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,5) as $index) 
        {
        	User::create([
        		'name' => $faker->userName,
        		'email' => $faker->email,
        		'password' => bcrypt('secret')
        	]);
        }
    }
}
