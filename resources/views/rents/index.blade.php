@extends('layouts.admin')

@section('contentheader_title')
    Rentals
@endsection

@section('main-content')
    @include('rents.partials.filter')
    @include('rents.partials.table')
    <div id="modal-rent-create"></div>
    <div id="modal-rent-edit"></div>
@endsection

@section('scripts')
    @parent
    @include('rents.partials.js.scripts')
@endsection
