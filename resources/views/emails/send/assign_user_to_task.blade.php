@extends('emails.app')

@section('subject', $subject)

@section('data')
    {{ $data['name'] }}
@endsection