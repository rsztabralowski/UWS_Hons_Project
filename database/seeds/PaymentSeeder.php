<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = array();
      
        $faker = Faker::create();
    	foreach (range(1,10) as $i) {
            $inserts[] = [
                'id' => $i,
                'amount' => $faker->randomFloat(2,30,1000), 
                'created_at' => date('Y-m-d H:i:s'),
                'paypaltoken' => Str::random(16),
            ];
        }

        foreach ($inserts as $insert) {
            \App\Payment::create($insert);
        }
    }
}
