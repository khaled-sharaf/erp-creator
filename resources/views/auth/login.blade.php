<!DOCTYPE html>
<html lang="en">
<head>
    <title> {{ config('app.name') . ' | Login' }} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <link rel="shortcut icon" href="{{ url('/') }}/favicon.ico" type="image/x-icon">

    {{-- {!! Html::style('login-style/vendor/bootstrap/css/bootstrap.min.css') !!} --}}
    {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css') !!}

    {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}

    {!! Html::style('login-style/css/main.css') !!}

</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ url('/') . '/' . getSettings('logo') }}" alt="Logo" draggable="false">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <span class="login100-form-title">
                        {{ config('app.name') . ' Login' }}
                    </span>


                    <div class="wrap-input100">
                        <input class="input100" value="{{ old('email') }}" type="text" name="email" placeholder="Email" autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember"  name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                    </div>

                    @if ($errors->has('email'))
                        <div class="error-login">
                           <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="error-login">
                           <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {!! Html::script('login-style/vendor/jquery/jquery-3.2.1.min.js') !!}
    {!! Html::script('login-style/vendor/bootstrap/js/popper.js') !!}
    {!! Html::script('login-style/vendor/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('login-style/vendor/tilt/tilt.jquery.min.js') !!}

    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    {!! Html::script('login-style/js/main.js') !!}
</body>
</html>
