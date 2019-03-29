<!doctype html>
<html>
<head>
    <base href="{{ asset('assets') }}/">
    <title>{{ trans('frontend.login') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="" />
    <link href="web/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="web/css/login.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/home.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    @yield('main');
</body>
</html>
