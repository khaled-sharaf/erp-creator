@extends('emails.app')

@section('subject', $subject)

@section('data')

    <div>
        Dear
        <div class="d-inline-block ltr bold"> {{ $data['name'] }} </div>.
        <br>
        We are glad to have confidence in 
        <div class="d-inline-block ltr bold"> {{ $settings['app_name_long'] }} </div>
        We always strive to provide our best experiences to be one of our success partners and join them as one of our respected clients.
        <br>

        You can also view the quotation in the attachments or through this link
        <a target="_blank" href="{{ url('quotation/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('quotation/pdf/' . $data['secret_id'] . '/view') }} </a>
        <br>
        We hope to obtain your satisfaction.
    </div>

    <br>
    <br>

    <div class="rtl">
        عزيزى
        <div class="d-inline-block ltr bold"> {{ $data['name'] }} </div>.
        <br>
        سعداء لثقتك فى شركة 
        <div class="d-inline-block ltr bold"> {{ $settings['app_name_long'] }} </div>
        ونسعى دائما لتقديم أفضل ما لدينا من خبرات لتكون أحد شركاء نجاحنا والإنضمام إليها كأحد عملائنا المحترمين.
        <br>

        ويمكنك أيضا الاطلاع على عرض الاسعار الخاص بكم طرفنا من المرفقات أو من خلال هذا الرابط
        <a target="_blank" href="{{ url('quotation/pdf/' . $data['secret_id'] . '/view') }}"> {{ url('quotation/pdf/' . $data['secret_id'] . '/view') }} </a>
        <br>
        ونتمنى ان ينال رضاكم.
    </div>

@endsection
