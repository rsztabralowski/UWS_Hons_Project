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
        return view('admin.users.index'); 
    }

     /**
     * Get data to be displayed in DataTables.
     *
     * @return DataTables
     */
    public function getdata()
    {
        $users = User::all();
        foreach($users as $user)
        {
            $response['data'][] = array(
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => $user->address,
                'action' => '<a href="users/'.$user->id.'" class="btn btn-primary edit" id="'.$user->id.'"><i class="fas fa-eye"></i></a>'
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
        return view('admin.users.create'); 
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

        $user = new User([
            'username' => Str::random(10),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'password' => Hash::make(Str::random())
        ]);

        $user->save();

        return redirect('/admin/users')->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'first_name' =>  'required',
            'last_name' =>  'required',
            'email' => 'email',
            'phone' => 'required|numeric'
        ]);

        $update_user = User::find($user->id);
        $update_user->first_name = $request->get('first_name');
        $update_user->last_name = $request->get('last_name');
        $update_user->phone = $request->get('phone');
        $update_user->email = $request->get('email');
        $update_user->address = $request->get('address');
       

        $update_user->save();

        return redirect('/admin/users')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/users')->with('success', 'User Deleted');
        // return redirect('/admin/users')->with('error', 'user can not be removed at the moment');
    }
}
