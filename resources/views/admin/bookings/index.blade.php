@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <table id="bookings_table" class="table table-bordered" style="witdt:100%">
        <thead>
            <tr>
                <th>Time From</th>
                <th>Time To</th>
                <th>Last Name</th>
                <th>Button</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('DataTablesScript')

            $('#bookings_table').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '{{ route('bookings.getdata') }}',
                'columns':[
                    { 'data': 'time_from'},
                    { 'data': 'time_to'},
                    { 'data': 'last_name'},
                    { 'data': 'button'},
                ]
            });
@endsection