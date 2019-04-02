@extends('user.master')
@section('main')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="js/user.js"></script>
<script src="js/notifi.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="content">
<a id="logout" href="{{ asset('logout') }}">logout ({{ Auth::user()->name }})</a>
<div id="app">
    <login-user></login-user>
</div>
</div>

<script src="/js/app.js"></script>
@stop
