@extends('layouts.admin')
@section('content')

@section('main-content')
{{--    @include('cars.partials.filter')--}}
    @include('cars.partials.table')
    <div id="modal-rent-create"></div>
@endsection

@section('scriptOnPage')
    @include('cars.partials.js.scripts')
{{--    @include('stkCarLeads.partials.js.scripts')--}}
@endsection
