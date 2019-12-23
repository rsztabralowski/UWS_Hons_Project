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

@section('DataTablesScript')
<script>
    $(document).ready(function(){
      var SITEURL = '{{URL::to('')}}';
      console.log(SITEURL);
            $('#users_table').DataTable({
                'processing': true,
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "pageLength": -1,
                'ajax': '{{ route('users.getdata') }}',
                'columns':[
                    { 'data': 'username'},
                    { 'data': 'first_name'},
                    { 'data': 'last_name'},
                    { 'data': 'email'},
                    { 'data': 'address'},
                    { 'data': 'phone'},
                    { 'data': 'action', orderable:false, searchable: false}
                ]
            });
        });
</script>
@endsection

