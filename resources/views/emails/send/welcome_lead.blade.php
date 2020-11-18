@extends('emails.app')

@section('subject', $subject)

@section('data')

    <div>
        Dear
        <div class="d-inline-block ltr bold">
            {{ $data['name'] }}
        </div>.
        <br>
        We are glad to have confidence in 
        <div class="d-inline-block ltr bold">
            {{ $settings['app_name_long'] }}
        </div>
        to join it as one of its respected clients.
    </div>

    <br>
    <br>

    <div class="rtl">
        عزيزى
        <div class="d-inline-block ltr bold">
            {{ $data['name'] }}
        </div>.
        <br>
        سعداء لثقتك فى شركة 
        <div class="d-inline-block ltr bold">
            {{ $settings['app_name_long'] }}
        </div>
        للإنضمام إليها كأحد عملائها المحترمين.
    </div>

@endsection
