@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('rooms.create')}}"><i class="fas fa-plus-circle"></i> {{ __('Add New Room') }}</a></button>
    </div>
    <div class="datatables_buttons">
        <button id="btn-show-all-children" class="btn btn-sm btn-dark" type="button">Expand All</button>
        <button id="btn-hide-all-children" class="btn btn-sm btn-dark" type="button">Collapse All</button>
        <br>
    </div>
    <br>
        <table id="rooms_table" class="display responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/rooms_datatables.js') }}"></script>
@endsection