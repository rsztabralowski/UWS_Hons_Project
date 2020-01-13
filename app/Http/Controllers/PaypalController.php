<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Booking;
use App\Room;
use App\CustomClass\Functions;
use Auth;
use Srmklive\PayPal\Services\ExpressCheckout;



class PaypalController extends Controller
{
    private $provider;

    public function __construct() 
    {
        $this->provider = new ExpressCheckout();
    }

    public function expressCheckout(Request $request) 
    {
        
        // get new payment id
        
        $payment_id = Functions::getRandomNumber(9);
            
        // Get the cart data
        $cart = $this->getCart($payment_id);
      
        // create new payment
        $payment = new Payment();
        $payment->id = $payment_id;
        $payment->title = $cart['invoice_description'];
        $payment->price = $cart['total'];
        $payment->save();
      
        // send a request to paypal 
        // paypal should respond with an array of data
        // the array should contain a link to paypal's payment system
        $response = $this->provider->setExpressCheckout($cart);
      
        // if there is no link redirect back with error message
        if (!$response['paypal_link']) 
        {
            Payment::find($payment_id)->delete();
            return redirect('/')->with(['code' => 'danger', 'message' => $response['L_LONGMESSAGE0']]);
            // For the actual error message dump out $response and see what's in there
        }
      
        // redirect to paypal
        // after payment is done paypal
        // will redirect us back to $this->expressCheckoutSuccess
        return redirect($response['paypal_link']);
    }

    private function getCart($payment_id)
    {
        $price = round((session('price') * 0.2), 2);

        return [
            'items' => [
                [
                    'name' => 'Booking deposit',
                    'price' => $price,
                    'qty' => 1,
                ],
            ],
            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/paypal/express-checkout-success'),
            // every payment id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $payment_id,
            'invoice_description' => "Order #" . $payment_id . " Invoice",
            'cancel_url' => url('paypal/cancelled'),
            // total is calculated by multiplying price with quantity of all cart items and then adding them up
            'total' => $price,
        ];
    }

    public function expressCheckoutSuccess(Request $request) {
        
        $token = $request->get('token');

        $PayerID = $request->get('PayerID');

        // initaly we paypal redirects us back with a token
        // but doesn't provide us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);
        
        // payment id is stored in INVNUM
        // because we set our payment to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the payment
        $payment_id = explode('_', $response['INVNUM'])[1];

        // find payment by id
        $payment = Payment::find($payment_id);

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) 
        {
            $payment->delete();
            return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // get cart data
        $cart = $this->getCart($payment_id);

        // perform transaction on PayPal
        // and get the payment status
        $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
        $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        // set payment status
        $payment->payment_status = $status;
        $payment->token = $token;

        // save the payment
        $payment->save();

        // App\Payment has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($payment->paid) 
        {
            $room = Room::where('room_number', session('room'))->first();

            $room_id = '';
            if (isset($room))
            {
                $room_id = $room->id;
            }
    
            $booking = new Booking([
                'time_from' => session('time_from'). ' 15:00:00',
                'time_to' => session('time_to'). ' 12:00:00',
                'more_info' => session('more_info'),
                'user_id' => Auth::id(),
                'room_id' => $room_id,
                'payment_id' => $payment_id
            ]);
    
            $booking->save();

            return redirect('/')->with(['code' => 'success', 'message' => 'Order #' . $payment->id . ' has been paid successfully!']);
        }
        
        $payment->delete();
        return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment for Order #' . $payment->id . '!']);
    }

    public function cancelled(Request $request) 
    {
        $token = $request->get('token');
        $response = $this->provider->getExpressCheckoutDetails($token);
        $payment_id = explode('_', $response['INVNUM'])[1];

        $payment = Payment::find($payment_id);

        if($payment->payment_status == 'Completed')
        {
            return redirect('/')->with(['code' => 'success', 'message' => 'Order #' . $payment->id . ' has been paid successfully!']);
        }
        else
        {
            $payment->delete();    
            return redirect('/')->with(['code' => 'warning', 'message' => 'PayPal payment has been cancelled']);
        }
        
    }
}
