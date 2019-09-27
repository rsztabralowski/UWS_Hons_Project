@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
        <span id="form_success_output"></span>
    <div align='right'>
        <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button>
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
                <th>Room number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('DataTablesScript')
{{-- <script> --}}
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

            $('#add_data').click(function(){
                $('#bookingModal').modal('show');
                $('#booking_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('insert');
                $('#action').val('Add');
            });

            $('#booking_form').on('submit', function(e){
                e.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: '{{ route ("bookings.store") }}',
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.error.length > 0)
                        {
                            var error_html = '';
                            for(var i = 0; i < data.error.length; i++)
                            {
                                error_html += "<div class='alert alert-danger'>" +data.error[i]+ "</div>";
                            }

                            $('#form_error_output').html(error_html); 
                        }
                        else
                        {
                            $('#form_success_output').html(data.success);
                            $('#booking_form')[0].reset();
                            $('#action').val('Add');
                            $('.modal-title').text('Add Data');
                            $('#button_action').val('insert');
                            $('#bookings_table').DataTable().ajax.reload();
                            $('#bookingModal').modal('hide');

                            setTimeout(function(){
                                $('#form_success_output').hide();
                              }, 2000);
                        }
                    }
                })
            });
        
{{-- </script> --}}
@endsection

@section('modal')
<div id="bookingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="booking_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal title">Add data</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <span id="form_error_output"></span>
                        <div class="form-group">
                            <label>Enter Time From</label>
                            <input type="text" name="time_from" id="time_from" class="form-control" />
                        </div>
                        <div class="form-group">
                                <label>Enter Time To</label>
                                <input type="text" name="time_to" id="time_to" class="form-control" />
                        </div>
                        <div class="form-group">
                                <label>More info</label>
                                <input type="text" name="more_info" id="more_info" class="form-control" />
                        </div>
                        <div class="form-group">
                                <label>Customer ID</label>
                                <input type="text" name="customer_id" id="customer_id" class="form-control" />
                        </div>
                        <div class="form-group">
                                <label>Room ID</label>
                                <input type="text" name="room_id" id="room_id" class="form-control" />
                        </div>
                        <div class="form-group">
                                <label>Payment ID</label>
                                <input type="text" name="payment_id" id="payment_id" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <input type="submit" name="submit" id="action" value="Add">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection