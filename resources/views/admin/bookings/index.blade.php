@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('bookings.create')}}"><i class="fas fa-plus-circle"></i> Add New Booking</a></button>
    </div>
    <br>
        <table id="bookings_table" class="display responsive" style="witdt:100%">
            <thead>
                <tr>
                    <th>Username</th>
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
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "pageLength": -1,
                'ajax': '{{ route('bookings.getdata') }}',
                'columns':[
                    { 'data': 'username'},
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

