@extends('user.master')
@section('main')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div id="content">
<a id="logout" href="{{ asset('logout') }}">logout ({{ Auth::user()->name }})</a>
<div id="app">
    <login-user></login-user>
</div>
</div>

@stop
