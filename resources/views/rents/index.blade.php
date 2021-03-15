@extends('layouts.admin')

@section('main-content')
    @include('rents.partials.filter')
    @include('rents.partials.table')
    <div id="modal-rent-create"></div>
@endsection

@section('scriptOnPage')
    @include('cars.partials.js.scripts')
{{--    @include('stkCarLeads.partials.js.scripts')--}}
@endsection
