@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('bookings.create')}}"><i class="fas fa-plus-circle"></i> {{ __('Add New Booking') }}</a></button>
    </div>
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="" id="current" data-get="">Current</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_past=1">Past</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_all=1">All</a></li>
        </ul>
    </p>
    <div class="datatables_buttons">
        <button id="btn-show-all-children" class="btn btn-sm btn-dark" type="button">Expand All</button>
        <button id="btn-hide-all-children" class="btn btn-sm btn-dark" type="button">Collapse All</button>
        <br>
    </div>
        <br>
        <table id="bookings_table" class="display responsive" style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Time from') }}</th>
                    <th>{{ __('Time to') }}</th>
                    <th>{{ __('Room') }}</th>
                    <th>{{ __('Nights') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Deposit') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
        </table>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/bookings_datatables.js') }}"></script>
@endsection