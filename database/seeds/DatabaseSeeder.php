<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomerSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(UserSeeder::class);
       
    }
}
