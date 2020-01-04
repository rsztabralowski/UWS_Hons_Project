@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('rooms.create')}}"><i class="fas fa-plus-circle"></i> Add New Room</a></button>
    </div>
    <br>
        <table id="rooms_table" class="display responsive" style="witdt:100%">
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

