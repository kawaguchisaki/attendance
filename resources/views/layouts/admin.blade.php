<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,inital-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com>
        <link href="https://fonts.googleapis.com/css? family=Releway:300,400,600" rel="stylesheet" type="text/css">
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
                <duv class="container">
                    <!--<a class="navbar-brand" href="{{ route('admin_home') }}">ホーム画面</a>-->
                    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
                    <!--    <span class="navbar-toggler-icon"></span>-->
                    <!--</button>-->
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('admin_home') }}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink-site" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                現場情報
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-site">
                                    <a class="dropdown-item" href="{{ route('new_site') }}">登録</a>
                                    <a class="dropdown-item" href="{{ route('sites') }}">一覧</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink-user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                従業員情報
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-user">
                                    <a class="dropdown-item" href="{{ route('new_user') }}">登録</a>
                                    <a class="dropdown-item" href="{{ route('users') }}">一覧</a>
                                </div>
                                
                            </li>
                        </ul>
                    </div>
                </duv>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>