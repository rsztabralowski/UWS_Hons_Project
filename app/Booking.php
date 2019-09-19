<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['time_from', 'time_to', 'more_info', 'customer_id', 'room_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
