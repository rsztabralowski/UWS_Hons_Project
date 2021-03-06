@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Find available rooms') }}</div>
                <div class="card-body range">
                   @include('admin.inc.messages')
                    <div class="d-flex justify-content-center">
                        <div class="row mt-4">
                            <div class='col-md-12 range'>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type='text' class="form-control" placeholder="{{ __('Please select dates') }}" name="daterange" id='daterange'/>
                                </div>
                            </div>
                            <input readonly type="hidden" name="time_from" id="time_from" value="" />
                            <input readonly type="hidden" name="time_to" id="time_to" value="" />
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                    <button id="search">{{ __('Search') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div id="result"></div>
</div>
    
@endsection

@section('script')

<script>
$(document).ready(function()
{
    $('#daterange').val('');

    $(function() 
    {
        $('#daterange').daterangepicker(
        {
            locale: {
                format: 'DD/MM/YYYY',
            },
            autoUpdateInput: false,
            opens: 'center',
            minDate: moment().add(1, 'day'),
        }, 
        function(start, end, label) 
        {
            $('#time_from').val(start.format('YYYY-MM-DD'));
            $('#time_to').val(end.format('YYYY-MM-DD'));
        });

        $('#daterange').on('apply.daterangepicker', function(ev, picker) 
        {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) 
        {
            $(this).val('');
        });
    });

    $('#search').on('click', function()
    {
        let time_from = $('#time_from').val();
        let time_to = $('#time_to').val();

        if(time_from == '' || time_to == '')
        {
            alert('Please select dates');
        }
        else if(time_from == time_to)
        {
            alert('Please select minimum next day');
        }
        else if( time_from < moment().add(1, 'day').format('YYYY-MM-DD')
            || time_to < moment().add(2, 'day').format('YYYY-MM-DD')
            || moment(time_from).format('YYYY-MM-DD') == 'Invalid date'                                    
            || moment(time_to).format('YYYY-MM-DD') == 'Invalid date')                                  
        {
            alert('Invalid dates');
        }
        else
        {
            $.ajax({
                url: 'user/checkavail',
                data: {
                    time_from: time_from,
                    time_to: time_to
                },
                method: 'GET',
                success: function(result)
                {
                    $('#result').html(result);

                    $('.session').on('click', function(e){
                        
                        let booking = $(this).data('booking');

                        $.ajax({
                            url: 'user/session',
                            async: false,
                            data: {
                                booking: booking
                            }
                        })
                    })
                }
            }) 
        }
    });

    

});
</script>  
@endsection


















