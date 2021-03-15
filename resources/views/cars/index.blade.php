@extends('layouts.admin')

@section('contentheader_title')
    Cars
@endsection

@section('main-content')
    @include('cars.partials.filter')
    @include('cars.partials.table')
    <div id="modal-car-create"></div>
    <div id="modal-rent-create"></div>
@endsection

@section('scripts')
@parent
    @include('cars.partials.js.scripts')
    @include('rents.partials.js.scripts')
@endsection
