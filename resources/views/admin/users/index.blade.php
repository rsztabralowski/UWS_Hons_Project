@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('users.create')}}"><i class="fas fa-plus-circle"></i> Add New User</a></button>
    </div>
    <div class="datatables_buttons">
        <button id="btn-show-all-children" class="btn btn-sm btn-dark" type="button">Expand All</button>
        <button id="btn-hide-all-children" class="btn btn-sm btn-dark" type="button">Collapse All</button>
        <br>
    </div>
    <br>
        <table id="users_table" class="display responsive" style="width:100%">
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
