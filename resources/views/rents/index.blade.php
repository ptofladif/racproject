@extends('layouts.admin')

@section('main-content')
    @include('rents.partials.filter')
    @include('rents.partials.table')
    <div id="modal-rent-create"></div>
@endsection

@section('scriptOnPage')
    @include('rents.partials.js.scripts')
@endsection
