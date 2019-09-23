<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = array();

        $inserts[] = 
            [
                'id' => 1,
                'room_number' => 101, 
                'price' => 55.50, 
                'description' => 'Nice one with ocean view',
                'created_at' => date('Y-m-d H:i:s')
        ];

        $faker = Faker::create();
    	foreach (range(2,10) as $i) {
            $inserts[] = [
                'id' => $i,
                'room_number' => '10'. $i, 
                'price' => $faker->randomFloat(2,30,100), 
                'description' => $faker->sentence(20),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        foreach ($inserts as $insert) {
            \App\Room::create($insert);
        }
    }
}
