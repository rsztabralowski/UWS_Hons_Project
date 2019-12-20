@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('rooms.create')}}"><i class="fas fa-plus-circle"></i> Add New Room</a></button>
    </div>
    <br>
    <div class="table-responsive">
        <table id="rooms_table" class="table table-bordered" style="witdt:100%">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('DataTablesScript')
<script>
    $(document).ready(function(){
      var SITEURL = '{{URL::to('')}}';
      console.log(SITEURL);
            $('#rooms_table').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'recordsFiltered': 28,
                'ajax': '{{ route('rooms.getdata') }}',
                'columns':[
                    { 'data': 'room_number'},
                    { 'data': 'price'},
                    { 'data': 'description'},
                    { 'data': 'action', orderable:false, searchable: false}
                ]
            });
        });
</script>
@endsection

