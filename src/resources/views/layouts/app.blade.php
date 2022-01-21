<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    <link rel="icon" type="image/png" href="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/favicon.png" />
    <link rel="icon" size="any" type="image/svg+xml" href="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/plotemo_favicon.svg">
    <!-- MDB 4.19.1 CSS-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/jpn.css@latest/dist/bootstrap/jpn.min.css">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        {{-- 個別のスタイルシート --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="app">
        @yield('header')

        @if (session('status'))
            <success-notification
                :notification='@json(session('status'))'
            ></success-notification>
        @endif

        @if (session('user_error_message'))
            <user-failure-notification
                :notification='@json(session('user_error_message'))'
            ></user-failure-notification>
        @endif

        @yield('content')
        @yield('footer')
    </div>

    <!-- MDB 4.19.1 JavaScript-->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <script src="{{ mix('js/bootstrap_custom.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
