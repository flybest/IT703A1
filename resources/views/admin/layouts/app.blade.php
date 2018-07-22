<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Appointment Management System') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    @yield('header')
    <!-- Place favicon.ico in the root directory -->
    <!-- Bootstrap Core CSS -->
    <link  rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    @stack('css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        @auth
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name', __('views.admin.title')) }}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->user_name}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--                                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>-->
                        <!--                                </li>-->
                        <!--                                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                        <!--                                </li>-->
                        <!--                                <li class="divider"></li>-->
                        <li><a href="{{ route('logout').'?'.csrf_token() }}"><i class="fa fa-sign-out fa-fw"></i> {{ __('views.admin.logout') }}</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> {{ __('views.admin.menu.dashboard') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('customers') }}"><i class="fa fa-money fa-fw"></i> {{ __('views.admin.menu.appointments') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('contacts') }}"><i class="fa fa-phone fa-fw"></i> {{ __('views.admin.menu.configuration') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admins') }}"><i class="fa fa-users fa-fw"></i> {{ __('views.admin.menu.admin_accounts') }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @endauth

    @yield('content')

    </div>
    <!-- /#wrapper -->
    @yield('footer')

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    @stack('scripts')
</body>
</html>