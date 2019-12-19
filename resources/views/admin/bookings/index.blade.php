@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
        <span id="form_success_output"></span>
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('bookings.create')}}">Add</a></button>
    </div>
    <br>
    <table id="bookings_table" class="table table-bordered" style="witdt:100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Room</th>
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
            $('#bookings_table').DataTable({
                'processing': true,
                'serverSide': true,
                'recordsFiltered': 28,
                'ajax': '{{ route('bookings.getdata') }}',
                'columns':[
                    { 'data': 'first_name'},
                    { 'data': 'last_name'},
                    { 'data': 'email'},
                    { 'data': 'time_from'},
                    { 'data': 'time_to'},
                    { 'data': 'room_number'},
                    { 'data': 'action', orderable:false, searchable: false}
                ]
            });
        });
</script>
@endsection

