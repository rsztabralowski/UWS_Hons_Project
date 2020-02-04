{{-- @if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger m-3">
            {{$error}}
        </div>
    @endforeach
@endif --}}

@if(session('success'))
    <div class="alert alert-success message">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger message">
        {{session('error')}}
    </div>
@endif

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

@if (session('message'))
<div class="alert alert-{{ session('code') }}">
    <p>{{ session('message') }}</p>
</div>
@endif