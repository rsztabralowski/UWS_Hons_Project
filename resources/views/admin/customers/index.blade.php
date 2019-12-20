@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('customers.create')}}"><i class="fas fa-plus-circle"></i> Add New Customer</a></button>
    </div>
    <br>
    <div class="table-responsive">
        <table id="customers_table" class="table table-bordered" style="witdt:100%">
            <thead>
                <tr>
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
</div>
@endsection

@section('DataTablesScript')
<script>
    $(document).ready(function(){
      var SITEURL = '{{URL::to('')}}';
      console.log(SITEURL);
            $('#customers_table').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'recordsFiltered': 28,
                'ajax': '{{ route('customers.getdata') }}',
                'columns':[
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
