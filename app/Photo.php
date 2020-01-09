<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['room_id', 'url'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

}
