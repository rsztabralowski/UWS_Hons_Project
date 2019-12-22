<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.index'); 
    }

     /**
     * Get data to be displayed in DataTables.
     *
     * @return DataTables
     */
    public function getdata()
    {
        $customers = User::all();
        foreach($customers as $customer)
        {
            $response['data'][] = array(
                'id' => $customer->id,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
                'action' => '<a href="customers/'.$customer->id.'" class="btn btn-primary edit" id="'.$customer->id.'"><i class="fas fa-eye"></i></a>'
            );
        }
            echo json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' =>  'required',
            'last_name' =>  'required',
            'email' => 'email|unique:users',
            'phone' => 'required|numeric'
        ]);

        $customer = new User([
            'username' => Str::random(10),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'password' => Hash::make(Str::random())
        ]);

        $customer->save();

        return redirect('/admin/customers')->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $customer)
    {
        return view('admin.customers.show')->with('customer', $customer);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('admin.customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $customer)
    {
        $this->validate($request, [
            'first_name' =>  'required',
            'last_name' =>  'required',
            'email' => 'email',
            'phone' => 'required|numeric'
        ]);

        $update_customer = User::find($customer->id);
        $update_customer->first_name = $request->get('first_name');
        $update_customer->last_name = $request->get('last_name');
        $update_customer->phone = $request->get('phone');
        $update_customer->email = $request->get('email');
        $update_customer->address = $request->get('address');
       

        $update_customer->save();

        return redirect('/admin/customers')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect('/admin/customers')->with('success', 'User Deleted');
        // return redirect('/admin/customers')->with('error', 'Customer can not be removed at the moment');
    }
}
