<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmBooking extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking_id)
    {
        
        $this->booking = Booking::find($booking_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@icingprint.co.uk', 'Admin')
                    // ->to('rsztabralowski@gmail.com')
                    ->subject('Booking confirmation')
                    ->view('emails.confirmed');
    }
}
