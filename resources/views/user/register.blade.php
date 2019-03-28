<!doctype html>
<html>
<head>
    <base href="{{ asset('web') }}/">
    <title>{{ trans('frontend.register') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="" />
    <script type="application/x-javascript" src="js/register.js"></script>
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
</head>
<script type="text/javascript">
    <script type="text/javascript">
    window.onload = function () {
        document.getElementById('password1').onchange = validatePassword;
        document.getElementById('password2').onchange = validatePassword;
    }
    function validatePassword(){
        var pass2 = document.getElementById('password2').value;
        var pass1 = document.getElementById('password1').value;
        if (pass1 != pass2)
            document.getElementById('password2').setCustomValidity(trans('frontend.confirmRegister'));
        else
            document.getElementById('password2').setCustomValidity('');
    }
</script>
</script>
<body>
    <h1 class="w3ls">{{ trans('frontend.loginAccout') }}</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
            <h2 class="agileits1">{{ trans('frontend.diamond') }}</h2>
            <p class="agileits2">{{ trans('frontend.lorem') }}</p>
        </div>
        <div class="content-agile2">
            {!! Form::open(array('route' => 'register', 'method' => 'POST')) !!}
            <div class="form-control w3layouts">
                @if ($errors->has('name'))
                <span class="copyrightt">{{ $errors->first('name') }}</span>
                @endif
                {!! Form::text('name', null, ['id' => 'firstname', 'placeholder' => trans('frontend.firstName')]) !!}
            </div>
            <div class="form-control w3layouts">
                @if ($errors->has('email'))
                <span class="copyrightt">{{ $errors->first('email') }}</span>
                @endif
                {!! Form::email('email', old('email'), ['id' => 'email', 'placeholder' => trans('frontend.email')]) !!}
            </div>
            <div class="form-control agileinfo">
                @if ($errors->has('password'))
                <span class="copyrightt">{{ $errors->first('password') }}</span>
                @endif
                {!! Form::password('password', ['id' => 'password1', 'placeholder' => trans('frontend.pass')]) !!}
            </div>  
            <div class="form-control agileinfo">
                @if ($errors->has('password_confirmation'))
                <span class="copyrightt">{{ $errors->first('name') }}</span>
                @endif
                {!! Form::password('password_confirmation', ['id' => 'password2', 'placeholder' => trans('frontend.passConfig')]) !!}
            </div>
            <input type="submit" class="register" value="Register">
            {!! Form::close() !!}
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
</body>
</html>
