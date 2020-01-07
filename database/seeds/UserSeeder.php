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
        $seedsCount = config('seedsCount.set_count');

        $inserts[] = 
        [
            'id' => 1,
            'username' => 'Robert', 
            'email' => 'rsztabralowski@gmail.com', 
            'password' => '$2y$10$fse1dSanO2r3VZ9o64ljROMR/o5kxYcKhrVtmpkFe3IhT0pb1TwfS', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
            'isAdmin' => 1
        ];
        $inserts[] =
        [
            'id' => 2,
            'username' => 'Mike', 
            'email' => 'mike@gmail.com', 
            'password' => '$2y$10$fse1dSanO2r3VZ9o64ljROMR/o5kxYcKhrVtmpkFe3IhT0pb1TwfS', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $inserts[] =
        [
            'id' => 3,
            'username' => 'John', 
            'email' => 'john@gmail.com', 
            'password' => '$2y$10$fse1dSanO2r3VZ9o64ljROMR/o5kxYcKhrVtmpkFe3IhT0pb1TwfS', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $inserts[] =
        [
            'id' => 4,
            'username' => 'Sam', 
            'email' => 'sam@gmail.com', 
            'password' => '$2y$10$fse1dSanO2r3VZ9o64ljROMR/o5kxYcKhrVtmpkFe3IhT0pb1TwfS', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $inserts[] =
        [
            'id' => 5,
            'username' => 'Laura', 
            'email' => 'laura@gmail.com', 
            'password' => '$2y$10$fse1dSanO2r3VZ9o64ljROMR/o5kxYcKhrVtmpkFe3IhT0pb1TwfS', 
            'remember_token' => '', 
            'created_at' => date('Y-m-d H:i:s'),
        ];
	
        foreach ($inserts as $insert) 
        {
            \App\User::create($insert);
        }
    }
}
