<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
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
                'first_name' => 'Robert', 
                'last_name' => 'Sztabralowski', 
                'address' => '55 Beardmore Place G81 4HU',
                'phone' => '07875649233',
                'email' => 'rsztabralowski@gmail.com', 
                'created_at' => date('Y-m-d H:i:s'),
        ];

        $faker = Faker::create();
    	foreach (range(2,10) as $i) {
            $inserts[] = [
                'id' => $i,
                'first_name' => $faker->firstName, 
                'last_name' => $faker->lastName, 
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email, 
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        foreach ($inserts as $insert) {
            \App\Customer::create($insert);
        }
    }
}
