@extends('emails.app')

@section('subject', $subject)

@section('data')

    <div>
        Glad to join the Google 
        <div class="d-inline-block ltr bold">
            {{ $settings['app_name_long'] }}
        </div>
        team.
        <br>

        You can log in through this link
        <a href="{{ url('/login') }}" target="_blank">{{ url('/login') }}</a>.

        <br>
        <br>

        <div class="bold">
            Login Information:
        </div>
        <span class="bold">Email:</span> {{ $data['email'] }}
        <br>
        <span class="bold">Password:</span> {{ $data['password'] }}
        <br>
        <br>
        Please complete your profile information through this link
        <a href="{{ url('/hr/users/'. $data["id"] . '/edit') }}" target="_blank">{{ url('/hr/users/'. $data["id"] . '/edit') }}</a>.
    </div>

    <br>
    <br>

    <div class="rtl">
        
        سعداء لانضمامك لفريق شركة
        <div class="d-inline-block ltr bold">
            {{ $settings['app_name_long'] }}
        </div>.
        <br>

        يمكنك تسجيل الدخول من خلال هذا الرابط
        <a href="{{ url('/login') }}" target="_blank">{{ url('/login') }}</a>.

        <br>
        <br>

        <div class="bold">
            بيانات الدخول:
        </div>
        <div class="ltr">
            <span class="bold">Email:</span> {{ $data['email'] }}
            <br>
            <span class="bold">Password:</span> {{ $data['password'] }}
        </div>
        <br>
        <br>
        يرجى استكمال بيانات الملف الشخصي الخاص بك من خلال هذا الرابط

        <a href="{{ url('/hr/users/'. $data["id"] . '/edit') }}" target="_blank">{{ url('/hr/users/'. $data["id"] . '/edit') }}</a>.
    </div>

@endsection