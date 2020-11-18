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
        <br>
        You can view our copy of the new contract with us through this link
        <a target="_blank" href="{{ url('contract/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('contract/pdf/' . $data['secret_id'] . '/view') }} </a>
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
        <br>
        يمكنك الاطلاع على نسخة التعاقد الجديد الخاص بكم طرفنا من المرفقات أو من خلال هذا الرابط
        <a target="_blank" href="{{ url('contract/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('contract/pdf/' . $data['secret_id'] . '/view') }} </a>
    </div>

@endsection
