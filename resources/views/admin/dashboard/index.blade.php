@extends('layouts.admin')

@section('content')

<br><br><br>
<div class="container">
    <div class="start_end">
        <div class="ending">
            <h4>{{$bookings['count']['ending']}}
                {{' booking'. ($bookings['count']['ending'] == 1 ? '' : 's') .' ending next week'}}
            </h4>
            <ul>
                @foreach ($bookings['ending'] as $booking)
                    {!!$booking!!}    
                @endforeach
            </ul>
        </div>
        <div class="starting">
        <h4>{{$bookings['count']['starting']}}
                {{' booking'. ($bookings['count']['starting'] == 1 ? '' : 's') .' starting next week'}}
        </h4>
            <ul>
                @foreach ($bookings['starting'] as $booking)
                   {!!$booking!!}  
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <!-- Content Row -->
    <div class="row">

      <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bookings (This Month)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$this_month_bookings_count}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bookings (This Year)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$this_year_bookings_count}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (This Month)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">&pound;{{number_format($this_month_income, 2)}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-pound-sign fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">&pound;{{number_format($this_year_income, 2)}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-pound-sign fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection