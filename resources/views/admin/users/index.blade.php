@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('users.create')}}"><i class="fas fa-plus-circle"></i> {{ __('Add New User') }}</a></button>
    </div>
    <div class="datatables_buttons">
        <button id="btn-show-all-children" class="btn btn-sm btn-dark" type="button">Expand All</button>
        <button id="btn-hide-all-children" class="btn btn-sm btn-dark" type="button">Collapse All</button>
        <br>
    </div>
    <br>
        <table id="users_table" class="display responsive" style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('First name') }}</th>
                    <th>{{ __('Last name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
        </table>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/users_datatables.js') }}"></script>
@endsection