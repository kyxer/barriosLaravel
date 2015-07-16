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
        <h2>
            <i class="ion-beer"></i>  Bienvenidos a la <span class="text-primary" >WEB</span> del
            <span class="text-success" >{{ $barrio['name'] }}</span>
        </h2>
    </div>
@stop