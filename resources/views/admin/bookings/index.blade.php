@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('bookings.create')}}"><i class="fas fa-plus-circle"></i> Add New Booking</a></button>
    </div>
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="" id="current" data-get="">Current</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_past=1">Past</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_all=1">All</a></li>
        </ul>
    </p>
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
      let table = '';

      $('#current').attr('style', 'font-weight: 700');

      table = $('#bookings_table').DataTable({
                'processing': true,
                "responsive": true,
                "order": [[ 2, "asc" ]],
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

      $(('#current, #past, #all')).on('click', function(e)
      {
          e.preventDefault();
          $('.list-inline-item a').removeAttr('style');
          $(this).attr('style', 'font-weight: 700');

          let query = $(this).data('get');
          table.destroy();
          table = $('#bookings_table').DataTable({
                'processing': true,
                "responsive": true,
                "order": [[ 2, "asc" ]],
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "pageLength": -1,
                'method': 'GET',
                'ajax': '{{ route('bookings.getdata') }}' + query,
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
    });
</script>
@endsection

