<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $inserts = array();

        $inserts[] = [
            'id' => 1,
            'name' => 'Robert', 
            'email' => 'rsztabralowski@gmail.com', 
            'password' => '$2y$10$akHCvTRpvma2eB8VOqUEoOtpWEelS2/e2TZK3LJyfLxuvw8MrQxVq', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
            'isAdmin' => 1
        ];

        $faker = Faker::create();
    	foreach (range(2,10) as $i) {
	       $inserts[] = [
                    'id' => $i,
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt('secret'),
                    'remember_token' => '',
                    'created_at' => date('Y-m-d H:i:s'),
	        ];

	}

        foreach ($inserts as $insert) {
            \App\User::create($insert);
        }
    }
}
