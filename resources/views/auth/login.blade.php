<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Strategic Surveys | Log in</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/theme/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{asset('/theme/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/theme/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/theme/dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<!-- Main navbar -->
<div class="navbar navbar-inverse"  style = "background-color:#fff;border-width:2px;border-bottom:#03A9F4 solid 2px;border-left:#fff;border-top:#fff;border-right:#fff;justify-content: initial" id="navbar-main">
    <div class="navbar-header">
        <!-- <a class="navbar-brand" href="#"> -->
        <a href="https://strategicsurveys.com.au"><img class="company-logo" src="https://demo.strategicsurveys.com.au/portal/assets/images/strategicsurveys_logo.png" style="  height:40px;padding-left:10px;padding-top:5px;"></a>
        <ul class="nav navbar-nav pull-right visible-xs-block hidden-md hidden-lg hidden-sm">
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-tab" color="white"></i></a>

</div>
<!-- /main navbar -->
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Strategic</b>Surveys</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Login to your account</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
{{--                <div class="col-xs-8">--}}
{{--                    <div class="checkbox icheck">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox"> Remember Me--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- /.col -->
                <div class="col-xs-12 form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a class="col-xs-12 text-center" href="{{ route('password.request') }}">I forgot my password</a><br>
{{--        <a href="/register" class="text-center col-xs-12">Register a new membership</a>--}}

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('/theme/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/theme/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script>

</script>
</body>
</html>

