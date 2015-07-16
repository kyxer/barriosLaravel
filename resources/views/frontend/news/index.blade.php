@extends('frontend.app')
@section('content')
    @if(!Auth::check())
        @include('frontend.modals.login')
        @include('frontend.modals.register')
        @include('frontend.modals.recover')
        @include('frontend.modals.avatar')
        @yield('modalLogin')
        @yield('modalRegister')
        @yield('modalRecover')
        @yield('modalAvatar')
    @endif
    <div class="jumbotron">
        <h2><i class="ion-beer"></i>  Bienvenidos a las <span class="text-success" >NOTICIAS</span> de <span class="text-primary" >{{ $barrio['name']  }}</span></h2>
        <p>Estos son los noticias para esta semana</p>
    </div>
@stop