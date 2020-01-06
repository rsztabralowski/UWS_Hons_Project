@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make reservation</div>

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

                   <p>Room: {{session('room')}}</p>
                   <p>From: {{date('d/m/Y', strtotime(session('time_from')))}}</p>
                   <p>To: {{date('d/m/Y', strtotime(session('time_to')))}}</p>
                   <p>Nights: {{session('nights')}}</p>
                   <p>Price: &pound;{{session('price')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection