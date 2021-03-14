@extends('layouts.admin')

@section('content')
    @include('cars.partials.filter')
    @include('cars.partials.table')
    <div id="modal-rent-create"></div>
@endsection

@section('scripts')
@parent
    @include('cars.partials.js.scripts')
{{--    @include('stkCarLeads.partials.js.scripts')--}}
@endsection
