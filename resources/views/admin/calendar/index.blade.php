@extends('layouts.admin')

@section('content')

    <div class="container_calendar">
        
        <h1 class="days">{{ __('Calendar') }}</h1>

        <div class="select_container">
            <div class="select_year">
                <label for="year">{{ __('Select Year') }}</label>
                <select name="year" class="form-control" id="year">
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <div class="select_month">
                <label for="month">{{ __('Select Month') }}</label>
                <select name="month" class="form-control" id="month">
                    <option value="01">{{ __('January') }}</option>
                    <option value="02">{{ __('February') }}</option>
                    <option value="03">{{ __('March') }}</option>
                    <option value="04">{{ __('April') }}</option>
                    <option value="05">{{ __('May') }}</option>
                    <option value="06">{{ __('June') }}</option>
                    <option value="07">{{ __('July') }}</option>
                    <option value="08">{{ __('August') }}</option>
                    <option value="09">{{ __('September') }}</option>
                    <option value="10">{{ __('October') }}</option>
                    <option value="11">{{ __('November') }}</option>
                    <option value="12">{{ __('December') }}</option>
                </select>
            </div>
        </div>
        <div id="selected_time"></div>
        <div class="calendar"></div>
    </div>  
@endsection

@section('script')
    <script src="{{ asset('js/calendar.js') }}"></script>
@endsection