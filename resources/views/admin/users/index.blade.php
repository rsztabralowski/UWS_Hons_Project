@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('users.create')}}"><i class="fas fa-plus-circle"></i> Add New User</a></button>
    </div>
    <br>
        <table id="users_table" class="display responsive" style="witdt:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
</div>
@endsection
