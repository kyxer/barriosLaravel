<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! HTML::favicon('assets/images/favicon.png') !!}
    <title>@yield('title', 'BarrioOS')</title>

    <!--{!! Html::style('assets/css/bootstrap-paper.min.css') !!}
    {!! Html::style('assets/css/ionicons.min.css') !!}
    {!! Html::style('assets/css/styles.css') !!} -->
    @if(isset($dashboard))
        <!-- DashboarCss -->
        {!! HTML::style('assets/css/style-home.css') !!}
        {!! HTML::style('assets/css/font-awesome.min.css') !!}
    @endif
    @if(isset($general))
        <!-- LoginCss -->
        {!! HTML::style('assets/css/bootstrap.min.css') !!}
        {!! HTML::style('assets/css/style.css') !!}
        {!! HTML::style('assets/css/responsive.css') !!}
        {!! HTML::style('assets/css/font-awesome.min.css') !!}
        {!! HTML::style('assets/css/menu.css') !!}
    @endif


    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700,900" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@if(isset($dashboard))
    @include('frontend.sections.headerDashboardNoAuth')
@endif
@if(isset($dashboardAuth))
    @include('frontend.sections.headerDashboardAuth')
@endif
@if(isset($auth))
    @include('frontend.sections.headerAuth')
@endif

<!--<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">barrioOS</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                    @if(session()->has('barrio_search'))
                        <li><a href="/{{ session()->get('barrio_search')->url_name }}">Inicio</a></li>
                        <li><a href="/{{ session()->get('barrio_search')->url_name }}/actividades">Actividades</a></li>
                        <li><a href="/{{ session()->get('barrio_search')->url_name }}/foros">Foros</a></li>
                        <li><a href="/{{ session()->get('barrio_search')->url_name }}/noticias">Noticias</a></li>
                    @else
                        <li><a href="/">Inicio</a></li>
                        <li><a class="jq-manual-login">Iniciar Sesi&oacute;n</a></li>
                        <li><a class="jq-manual-register">Registrarse</a></li>
                    @endif
                @elseif(session()->has('barrio'))
                    <li><a href="/{{ session()->get('barrio')->url_name }}">Inicio</a></li>
                    <li><a href="/{{ session()->get('barrio')->url_name }}/actividades">Actividades</a></li>
                    <li><a href="/{{ session()->get('barrio')->url_name }}/foros">Foros</a></li>
                    <li><a href="/{{ session()->get('barrio')->url_name }}/noticias">Noticias</a></li>
                @elseif(session()->has('barrio_search'))
                    <li><a href="/{{ session()->get('barrio_search')->url_name }}">Inicio</a></li>
                    <li><a href="/{{ session()->get('barrio_search')->url_name }}/actividades">Actividades</a></li>
                    <li><a href="/{{ session()->get('barrio_search')->url_name }}/foros">Foros</a></li>
                    <li><a href="/{{ session()->get('barrio_search')->url_name }}/noticias">Noticias</a></li>
                @endif
            </ul>
            @if (Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/perfil">Pérfile</a></li>
                            <li><a href="{{ URL::route('logout') }}">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            @elseif(session()->has('barrio_search'))
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="jq-manual-login">Iniciar Sesi&oacute;n</a></li>
                    <li><a class="jq-manual-register">Registrarse</a></li>
                </ul>
            @endif

        </div>
    </div>
</nav> -->

@yield('content')

@if(isset($dashboard))
    @include('frontend.sections.footerDashboardNoAuth')
@endif
@if(isset($general))
    @include('frontend.sections.footerAuth')
@endif


<!-- Scripts -->
{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
{!! HTML::script('assets/js/bootstrap.min.js') !!}
{!! HTML::script('assets/js/bootstrap.validator.js') !!}
{!! HTML::script('assets/js/jquery.ui.widget.js')  !!}
{!! HTML::script('assets/js/jquery.iframe-transport.js')  !!}
{!! HTML::script('assets/js/jquery.fileupload.js')  !!}
{!! HTML::script('assets/js/main.js') !!}


</body>
</html>