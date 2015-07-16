@include('frontend.modals.login')
@include('frontend.modals.register')
@include('frontend.modals.recover')
@include('frontend.modals.avatar')
@include('frontend.forms.searchBarrio')
@extends('frontend.app')
@section('content')
    @yield('modalLogin')
    @yield('modalRegister')
    @yield('modalRecover')
    @yield('modalAvatar')
    <div class="jumbotron">
        <p>
            <a class="btn btn-lg btn-success" data-toggle="modal" data-target=".jq-login" ><i class="ion-log-in"></i>  Iniciar Sesi&oacute;n</a>
            <a class="btn btn-lg btn-primary" data-toggle="modal" data-target=".jq-register" ><i class="ion-person-add"></i>  Registrarse</a>
        </p>
        <h2><i class="ion-images"></i>Bienvenidos a barrioOS</h2>
        <p>Introduce tu codigo postal de 5 numeros</p>
        @yield('searchBarrioForm')
    </div>
@stop