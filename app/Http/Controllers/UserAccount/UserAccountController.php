<?php

namespace App\Http\Controllers\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\User;

class UserAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the User account home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user_account.home');
    }

    public function make_reservation()
    { 
        return view('user_account.make_reservation');
    }

    public function bookings()
    { 
        $bookings = Booking::where('user_id', Auth::id())
                            ->orderBy('time_from')
                            ->orderBy('time_to')
                            ->get();

        return view('user_account.bookings')->with('bookings', $bookings);
    }

    public function account()
    { 
        $user = User::find(Auth::id());

        return view('user_account.account')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$user->id.',id',
            'email' => 'email|unique:users,email,'.$user->id.',id',
            'phone' => 'nullable|numeric'
        ]);

        $update_user = User::find($user->id);
        $update_user->username = $request->get('username');
        $update_user->first_name = $request->get('first_name');
        $update_user->last_name = $request->get('last_name');
        $update_user->phone = $request->get('phone');
        $update_user->email = $request->get('email');
        $update_user->address = $request->get('address');
       

        $update_user->save();

        return redirect('/account')->with('success', 'Account Updated');
    }
}
