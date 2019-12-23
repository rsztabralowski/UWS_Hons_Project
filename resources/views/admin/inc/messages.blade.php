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