<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> {{ Config::get('constants.SITE_NAME') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/theme/dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <!--  <link rel="stylesheet" href="{{ asset('public/theme/plugins/iCheck/square/blue.css') }}"> -->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style type="text/css">
            .error{color: red;}
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:void(0)"><b>{{ Config::get('constants.SITE_FIRST_NAME') }}</b>{{ Config::get('constants.SITE_LAST_NAME') }}</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">

                <p class="login-box-msg">Login Here !!</p>

                <form action="{{ url('admin/post-auth') }}" method="post" name="auth" id="auth">
                    {{ csrf_field() }}
                    <p class="error help-block" style="text-align: center;color: red;" id="error">
                        @if ($errors->has('error'))
                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('error') }}
                        @endif
                    </p>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p class="error help-block" style="color: red;" id="error">
                            @if ($errors->has('email'))
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}
                            @endif
                        </p>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <p class="error help-block" style="color: red;" id="error">
                            @if ($errors->has('password'))
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('password') }}
                            @endif
                        </p>
                    </div>
                    <div class="row">
                        <br>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <a href="{{ url('admin/forgot-auth') }}" class="btn btn-primary btn-block btn-flat">Forgot Password</a>
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="{{ asset('public/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('public/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/custom-validation.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('public/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    </body>
</html>
