@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Make reservation') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(\Session::has('error'))
                        <div class="alert alert-danger">
                            {{\Session::get('error')}}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{ __('Room') }}: {{session('room')}}</h5>
                          <hr>
                          <div class="row">
                                <div class="col-md-6">
                                    <img class="w-100" src="{{asset('storage/room_photos')}}/{{session('photo')}}" alt="photo">
                                </div>

                                <div class="col-md-6 reservation_info">
                                    <h2>{{session('nights')}} {{session('nights') > 1 ? ''. __('Nights') .'' : ''. __('Night') .''}}</h2>
                                    <div class="mt-4 mb-3"><i class="fa fa-calendar"></i> &nbsp; <span>{{date('d M Y', strtotime(session('time_from')))}}</span></div>
                                    <div class="mb-3"><i class="fa fa-calendar"></i> &nbsp; <span>{{date('d M Y', strtotime(session('time_to')))}}</span></div>
                                    <div class="price">{{ __('Price') }}: &pound;{{session('price')}}</div>
                                    <div><small>({{ __('Today pay only') }} &pound;{{round (session('price') * 0.2, 2)}} {{ __('deposit') }})</small></div>
                                </div>
                          </div>
                          <div class="row mt-4 d-flex justify-content-center m-5">
                              <a class="paypal" href="{{ route('paypal.express-checkout') }}"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_150x38.png" alt="PayPal" /></a>
                              
                          </div>
                        </div>
                      </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection