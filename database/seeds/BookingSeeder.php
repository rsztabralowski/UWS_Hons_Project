<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedsCount = config('seedsCount.set_count');
        $date = date('Y-m-d H:i:s');
        $date_add_days = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($date)));

        $faker = Faker::create();
    	foreach (range(1, $seedsCount) as $i) {
            $inserts[] = [
                'id' => $i,
                'time_from' => $date, 
                'time_to' => $date_add_days, 
                'more_info' => $faker->sentence(15) , 
                'created_at' => date('Y-m-d H:i:s'),
                'customer_id' => $faker->numberBetween(1,$seedsCount), 
                'room_id' => $faker->numberBetween(1,10),
                'payment_id' => $faker->numberBetween(1,$seedsCount)

            ];
        }

        foreach ($inserts as $insert) {
            \App\Booking::create($insert);
        }
    }
}
