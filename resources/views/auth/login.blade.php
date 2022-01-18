<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,inital-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ログイン</title>
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com>
        <link href="https://fonts.googleapis.com/css? family=Releway:300,400,600" rel="stylesheet" type="text/css">
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <main class="py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="login-box card mb-3">
                                <div class="login-header card-header mx-auto">{{ __('messages.Login') }}</div>
                                <div class="login-body card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="email" class="col-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>
                                            <div class="col-6">
                                                <input id="email" type="email" class="form-controll{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>
                                            <div class="col-6">
                                                <input id="password" type="password" class="form-controll{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6 offset-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'check' : '' }}> {{ __('messages.Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">{{ __('messages.Login') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 text-right">
                            <a class="btn btn-dark" href="{{ route('register') }}">新規登録</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>