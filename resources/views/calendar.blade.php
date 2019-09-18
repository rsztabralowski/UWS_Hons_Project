@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <h1>You are logged in</h1>
        @else 
            <h1>You are a guest</h1>
        @endauth
    </div>  
@endsection  