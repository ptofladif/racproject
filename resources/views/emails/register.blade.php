@extends('layouts.email')

@section('mail_title')
    {{$title}}
@endsection

@section('mail_content')

    Welcome {{$user->name}},

    Your account was successfully created with the email {{$user->email}}

    Best regards,
    Rac Team

@endsection
