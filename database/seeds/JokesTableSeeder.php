<?php

use Illuminate\Database\Seeder;
use App\Joke;
use App\User;

class JokesTableSeeder extends Seeder
{
    /**
    * Run the database seeds
    * @return void
    **/
    public function run()
    {
    	//Faker object to load the data
        $faker = Faker\Factory::create();

        foreach (range(1,60) as $index) 
        {
        	Joke::create([
        		'body' => $faker->paragraph($nbSentences = 3),
        		'user_id' => $faker->numberBetween($min =1, $max = 10)
        	]);
        }
    }
}
