@extends('emails.app')

@section('subject', $subject)

@section('data')

    <div>
        Dear
        <div class="d-inline-block ltr bold"> {{ $data['name'] }} </div>.
        <br>
        We are glad to have confidence in 
        <div class="d-inline-block ltr bold"> {{ $settings['app_name_long'] }} </div>
        to join it as one of its respected clients.
        <br>

        The sum of
        <div class="d-inline-block ltr bold"> {{ $data['payment']['amount'] }} </div>
        EGP was paid on
        <div class="d-inline-block ltr bold"> {{ $data['payment']['date'] }} </div>.
        <br>
        You can view a receipt for the amount paid in the files attachments with the mail.
        <br>
        You can also view the invoice in the attachments or through this link
        <a target="_blank" href="{{ url('invoice/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('invoice/pdf/' . $data['secret_id'] . '/view') }} </a>

    </div>

    <br>
    <br>

    <div class="rtl">
        عزيزى
        <div class="d-inline-block ltr bold"> {{ $data['name'] }} </div>.
        <br>
        سعداء لثقتك فى شركة 
        <div class="d-inline-block ltr bold"> {{ $settings['app_name_long'] }} </div>
        للإنضمام إليها كأحد عملائها المحترمين.
        <br>

        تم سداد مبلغ 
        <div class="d-inline-block ltr bold"> {{ $data['payment']['amount'] }} </div>
        جنية مصرى من التعاقد الخاص بكم بتاريخ
        <div class="d-inline-block ltr bold"> {{ $data['payment']['date'] }} </div>.
        <br>
        يمكنك الاطلاع على صورة الإيصال بالمبلغ المدفوع فى المرفقات مع البريد.
        <br>
        ويمكنك أيضا الاطلاع على الفاتورة من المرفقات أو من خلال هذا الرابط
        <a target="_blank" href="{{ url('invoice/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('invoice/pdf/' . $data['secret_id'] . '/view') }} </a>
    </div>

@endsection
