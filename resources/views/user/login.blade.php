@extends('user.master')
@section('main')
    <h1 class="w3ls">{{ trans('frontend.login') }}</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
            <h2 class="agileits1">{{ trans('frontend.diamond') }}</h2>
            <p class="agileits2">{{ trans('frontend.lorem') }}</p>
        </div>
        <div class="content-agile2">
            {!! Form::open(array('route' => 'login', 'method' => 'POST')) !!}
            @include('errors.note')
            <div class="form-control w3layouts">
                {!! Form::email('email', old('email'), ['id' => 'email', 'placeholder' => trans('frontend.email'), 'required']) !!}
            </div>
            <div class="form-control agileinfo">
                {!! Form::password('password', ['id' => 'password1', 'placeholder' => trans('frontend.pass'), 'required']) !!}
            </div>
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('remember', 'ok', false) !!}
                    {{ trans('frontend.remember') }}
                </label>
            </div>
            {!! Form::submit(trans('remember.Login'), ['class' => 'register']) !!}
            {!! Form::close() !!}
            <p class="wthree w3l">{{ trans('frontend.account') }}<a href="{{ route('register') }}">{{ trans('frontend.registration') }}</a></p>
            <p class="wthree w3l">{{ trans('frontend.fast') }}</p>
            <ul class="social-agileinfo wthree2">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <p class="copyright w3l">{{ trans('frontend.design') }}<a href="#" target="_blank">{{ trans('frontend.lxc') }}</a></p>
@stop
