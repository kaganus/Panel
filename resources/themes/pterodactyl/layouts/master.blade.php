{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Pterodactyl') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#367fa9">
        <script src="/js/lang/{{ config('app.locale') }}.js"></script>

        @include('layouts.scripts')

        @section('scripts')
            {!! Theme::css('vendor/bootstrap/bootstrap.min.css') !!}
            {!! Theme::css('vendor/adminlte/admin.min.css') !!}
            {!! Theme::css('vendor/adminlte/colors/skin-blue.min.css') !!}
            {!! Theme::css('vendor/sweetalert/sweetalert.min.css') !!}
            {!! Theme::css('vendor/animate/animate.min.css') !!}
            {!! Theme::css('css/pterodactyl.css') !!}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        @show
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('index') }}" class="logo">
                    <span>{{ config('app.name', 'Pterodactyl') }}</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="user-menu">
                                <a href="{{ route('account') }}">
                                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" class="user-image" alt="@lang('strings.user_image')">
                                    <span class="hidden-xs">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</span>
                                </a>
                            </li>
                            {{--<li>--}}
                                {{--<a href="#" data-action="control-sidebar" data-toggle="tooltip" data-placement="bottom" title="@lang('strings.servers')"><i class="fa fa-server"></i></a>--}}
                            {{--</li>--}}
                            @if(Auth::user()->root_admin)
                                <li>
                                    <li><a href="{{ route('admin.index') }}" data-toggle="tooltip" data-placement="bottom" title="@lang('strings.admin_cp')"><i class="fa fa-gears"></i></a></li>
                                </li>
                            @endif
                            <li>
                                <li><a href="{{ route('auth.logout') }}" id="logoutButton" data-toggle="tooltip" data-placement="bottom" title="@lang('strings.logout')"><i class="fa fa-sign-out"></i></a></li>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    @if (isset($server->name) && isset($node->name))
                        <div class="user-panel">
                            <div class="info">
                              <p>{{ $server->name }}</p>
                              <a href="#" id="server_status_icon"><i class="fa fa-circle text-default"></i> @lang('strings.checking')</a>
                            </div>
                        </div>
                    @endif
                    <ul class="sidebar-menu tree" data-widget="tree">
                        <li class="header">@lang('navigation.account.header')</li>
                        <li class="{{ Route::currentRouteName() !== 'account' ?: 'active' }}">
                            <a href="{{ route('account') }}">
                                <i class="fa fa-user"></i> <span>@lang('navigation.account.my_account')</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() !== 'account.security' ?: 'active' }}">
                            <a href="{{ route('account.security')}}">
                                <i class="fa fa-lock"></i> <span>@lang('navigation.account.security_controls')</span>
                            </a>
                        </li>
                        {{--<li class="{{ (Route::currentRouteName() !== 'account.api' && Route::currentRouteName() !== 'account.api.new') ?: 'active' }}">--}}
                            {{--<a href="{{ route('account.api')}}">--}}
                                {{--<i class="fa fa-code"></i> <span>@lang('navigation.account.api_access')</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li class="{{ Route::currentRouteName() !== 'index' ?: 'active' }}">
                            <a href="{{ route('index')}}">
                                <i class="fa fa-server"></i> <span>@lang('navigation.account.my_servers')</span>
                            </a>
                        </li>
                        @if (isset($server->name) && isset($node->name))
                            <li class="header">@lang('navigation.server.header')</li>
                            <li class="{{ Route::currentRouteName() !== 'server.index' ?: 'active' }}">
                                <a href="{{ route('server.index', $server->uuidShort) }}">
                                    <i class="fa fa-terminal"></i> <span>@lang('navigation.server.console')</span>
                                    <span class="pull-right-container muted muted-hover" href="{{ route('server.console', $server->uuidShort) }}" id="console-popout">
                                        <span class="label label-default pull-right" style="padding: 3px 5px 2px 5px;">
                                            <i class="fa fa-external-link"></i>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @can('list-files', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.files'))
                                        class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.files.index', $server->uuidShort) }}">
                                        <i class="fa fa-files-o"></i> <span>@lang('navigation.server.file_management')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('list-admins', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.admins'))
                                        class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.admins', $server->uuidShort) }}">
                                        <i class="fa fa-user-circle"></i> <span>@lang('navigation.server.admin_management')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('list-plugins', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.plugins'))
                                        class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.plugins', $server->uuidShort) }}">
                                        <i class="fa fa-puzzle-piece"></i> <span>@lang('navigation.server.plugin_management')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('list-subusers', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.subusers'))
                                        class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.subusers', $server->uuidShort)}}">
                                        <i class="fa fa-users"></i> <span>@lang('navigation.server.subusers')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('list-tasks', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.schedules'))
                                        class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.schedules', $server->uuidShort)}}">
                                        <i class="fa fa-clock-o"></i> <span>@lang('navigation.server.schedules')</span>
                                        <span class="pull-right-container">
                                            <span class="label label-primary pull-right">{{ \Pterodactyl\Models\Schedule::select('id')->where('server_id', $server->id)->where('is_active', 1)->count() }}</span>
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-databases', $server)
                                <li
                                    @if(starts_with(Route::currentRouteName(), 'server.databases'))
                                    class="active"
                                    @endif
                                >
                                    <a href="{{ route('server.databases.index', $server->uuidShort)}}">
                                        <i class="fa fa-database"></i> <span>@lang('navigation.server.databases')</span>
                                    </a>
                                </li>
                            @endcan
                            @if(Gate::allows('view-startup', $server) || Gate::allows('view-sftp', $server) ||  Gate::allows('view-allocation', $server))
                                <li class="treeview
                                    @if(starts_with(Route::currentRouteName(), 'server.settings'))
                                        active
                                    @endif
                                ">
                                    <a href="#">
                                        <i class="fa fa-gears"></i>
                                        <span>@lang('navigation.server.configuration')</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        @can('view-allocation', $server)
                                            <li class="{{ Route::currentRouteName() !== 'server.settings.allocation' ?: 'active' }}"><a href="{{ route('server.settings.allocation', $server->uuidShort) }}"><i class="fa fa-handshake-o"></i> @lang('navigation.server.port_allocations')</a></li>
                                        @endcan
                                        @can('view-sftp', $server)
                                            <li class="{{ Route::currentRouteName() !== 'server.settings.sftp' ?: 'active' }}"><a href="{{ route('server.settings.sftp', $server->uuidShort) }}"><i class="fa fa-upload"></i> @lang('navigation.server.sftp_settings')</a></li>
                                        @endcan
                                        @can('view-startup', $server)
                                            <li class="{{ Route::currentRouteName() !== 'server.settings.startup' ?: 'active' }}"><a href="{{ route('server.settings.startup', $server->uuidShort) }}"><i class="fa fa-play"></i> @lang('navigation.server.startup_parameters')</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->root_admin)
                                <li class="header">@lang('navigation.server.admin_header')</li>
                                <li>
                                    <a href="{{ route('admin.servers.view', $server->id) }}" target="_blank">
                                        <i class="fa fa-cog"></i> <span>@lang('navigation.server.admin')</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    @yield('content-header')
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @lang('base.validation_error')<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
                                    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                                        {!! $message !!}
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right small text-gray" style="margin-right:10px;margin-top:-7px;">
                    <strong><i class="fa fa-fw {{ $appIsGit ? 'fa-git-square' : 'fa-code-fork' }}"></i></strong> {{ $appVersion }}<br />
                    <strong><i class="fa fa-fw fa-clock-o"></i></strong> {{ round(microtime(true) - LARAVEL_START, 3) }}s
                </div>
                <a href="https://www.oyunhost.net/">oyunhost.net</a> &copy; {{ date('Y') }}
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
                <div class="tab-content">
                    <ul class="control-sidebar-menu">
                        {{-- @todo replace this with better logic, or just remove it entirely? --}}
                        {{--@foreach (Auth::user()->access(null)->get() as $s)--}}
                            {{--<li>--}}
                                {{--<a--}}
                                    {{--@if(isset($server) && isset($node))--}}
                                        {{--@if($server->uuidShort === $s->uuidShort)--}}
                                            {{--class="active"--}}
                                        {{--@endif--}}
                                    {{--@endif--}}
                                {{--href="{{ route('server.index', $s->uuidShort) }}">--}}
                                    {{--@if($s->owner_id === Auth::user()->id)--}}
                                        {{--<i class="menu-icon fa fa-user bg-blue"></i>--}}
                                    {{--@else--}}
                                        {{--<i class="menu-icon fa fa-user-o bg-gray"></i>--}}
                                    {{--@endif--}}
                                    {{--<div class="menu-info">--}}
                                        {{--<h4 class="control-sidebar-subheading">{{ $s->name }}</h4>--}}
                                        {{--<p>{{ $s->username }}</p>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    </ul>
                </div>
            </aside>
            <div class="control-sidebar-bg"></div>
        </div>
        @section('footer-scripts')
            {!! Theme::js('js/keyboard.polyfill.js') !!}
            <script>keyboardeventKeyPolyfill.polyfill();</script>

            {!! Theme::js('js/laroute.js') !!}
            {!! Theme::js('vendor/jquery/jquery.min.js') !!}
            {!! Theme::js('vendor/sweetalert/sweetalert.min.js') !!}
            {!! Theme::js('vendor/bootstrap/bootstrap.min.js') !!}
            {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js') !!}
            {!! Theme::js('vendor/adminlte/app.min.js') !!}
            {!! Theme::js('vendor/socketio/socket.io.v203.min.js') !!}
            {!! Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js') !!}
            {!! Theme::js('js/autocomplete.js') !!}
            @if(config('pterodactyl.lang.in_context'))
                {!! Theme::js('vendor/phraseapp/phraseapp.js') !!}
            @endif

            @if(Auth::user()->root_admin)
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();

                        var that = this;
                        swal({
                            title: '@lang('strings.logout_confirm_title')',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '@lang('strings.logout_confirm_button')'
                        }, function () {
                            window.location = $(that).attr('href');
                        });
                    });
                </script>
            @endif
        @show
    </body>
</html>
