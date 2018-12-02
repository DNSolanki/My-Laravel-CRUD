<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ Config::get('constants.SITE_NAME') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('public/theme/dist/css/skins/_all-skins.min.css') }}">

        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset('public/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/theme/bower_components/select2/dist/css/select2.min.css') }}">
        <link href="{{ asset('public/theme/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

        <!-- jQuery 3 -->
        <script src="{{ asset('public/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('public/jquery.validate.min.js') }}"></script>
         <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('public/theme/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
         <script src="{{ asset('public/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- <link href="{{ asset('public/sweetalert.min.js') }}" rel="stylesheet"> -->

        <script type="text/javascript">
            var SITEURL = '{{URL::to('')}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script> 

        <style type="text/css">
           span.error + span.select2.select2-container.select2-container--default{
            margin-bottom: 17px;
        }
        span#country_id-error, span#state_id-error,span#city_id-error,span#company_id-error,span#payment_mode-error,span#type-error{
            position: absolute;
            top: 59px;
            left: 16px;
        }
        </style>

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @yield('css')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>{{ Config::get('constants.SITE_SHORT_FIRST_NAME') }}</b>{{ Config::get('constants.SITE_SHORT_LAST_NAME') }}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>{{ Config::get('constants.SITE_FIRST_NAME') }}</b>{{ Config::get('constants.SITE_LAST_NAME') }}</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                           
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                                    page and may cause design problems
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-user text-red"></i> You changed your username
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                           
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('public/theme/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ asset('public/theme/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ auth()->user()->name }}
                                            <small>{{ auth()->user()->email }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ url('admin/profile') }}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                           
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('public/theme/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ auth()->user()->name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span> Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview ">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Manage Users</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class=""><a href="{{ route('admin.users.create') }}"><i class="fa fa-circle-o"></i>Add User</a></li>
                                <li class=""><a href="{{ route('admin.users.index') }}"><i class="fa fa-circle-o"></i>Users List</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Manage Company</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class=""><a href="{{ route('admin.companies.create') }}"><i class="fa fa-circle-o"></i>Add Company</a></li>
                                <li class=""><a href="{{ route('admin.companies.index') }}"><i class="fa fa-circle-o"></i>Company List</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Manage Voucher</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class=""><a href="{{ route('admin.vouchers.create') }}"><i class="fa fa-circle-o"></i>Add Voucher</a></li>
                                <li class=""><a href="{{ route('admin.vouchers.index') }}"><i class="fa fa-circle-o"></i>Voucher List</a></li>
                            </ul>
                        </li>

                         <li class=""><a href="{{ route('admin.lesars.index') }}"><i class="fa fa-circle-o"></i>Lesar List</a></li>

                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            @if(Session::has('success'))

            <script type="text/javascript">

                swal({
                    title: 'Success!',
                    text: "{{Session::get('success')}}",
                    timer: 5000,
                    type: 'success'
                }).then((value) => {
                    //location.reload();
                }).catch(swal.noop);
            </script>
            @endif

            @if(Session::has('fail'))
            <script type="text/javascript">
                swal({
                    title: 'Oops!',
                    text: "{{Session::get('fail')}}",
                    type: 'error',
                    timer: 5000
                }).then((value) => {
                    //location.reload();
                }).catch(swal.noop);
            </script>
            @endif
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content-header">
                    <h1>
                      {{ $title }}
                      <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                      <li class="active">{{ $title }} </li>
                    </ol>
                </section>
                <!-- Main content -->
                @yield('content')
                <!-- /.content -->
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; {{ date('Y')}} <a href="https://adminlte.io">{{ Config::get('constants.SITE_NAME') }}</a>.</strong> All rights
                reserved.
            </footer>

            <!-- <div class="control-sidebar-bg"></div> -->
        </div>
        <!-- ./wrapper -->


        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
                $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- daterangepicker -->
        <script src="{{ asset('public/theme/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('public/theme/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <!-- datepicker -->
        <script src="{{ asset('public/theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('public/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('public/theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('public/theme/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('public/admin.js') }}"></script>
        <script src="{{ asset('public/custom-validation.js') }}"></script>
        <script src="{{ asset('public/theme/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('public/theme/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
        <script type="text/javascript">
        //Enable sidebar dinamic menu
        var url = window.location;
         // Will only work if string in href matches with location
        $('.sidebar-menu li a[href="' + url + '"]').parent().addClass('active');
        // Will only work if string in href matches with location
        $('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
        // Will also work for relative and absolute hrefs
        $('.treeview-menu li a').filter(function() {
            return this.href == url;
        }).parent().parent().parent().addClass('active');
        </script>

        @yield('js')
    </body>
</html>
