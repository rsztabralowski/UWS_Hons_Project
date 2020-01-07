<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['title', 'price', 'payment_status', 'token'];

    public function getPaidAttribute() 
    {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
    }
}