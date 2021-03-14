@extends('layouts.admin')

@section('contentheader_title')
    Cars
@endsection

@section('main-content')
    @include('cars.partials.filter')
    @include('cars.partials.table')
    <div id="modal-car-create"></div>
@endsection

@section('scripts')
@parent
    @include('cars.partials.js.scripts')
{{--    @include('stkCarLeads.partials.js.scripts')--}}
@endsection
