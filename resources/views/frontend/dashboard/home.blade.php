@include('frontend.modals.login')
@include('frontend.modals.recover')
@include('frontend.modals.avatar')
@include('frontend.forms.register')
@extends('frontend.app')
@section('content')
    @yield('modalLogin')
    @yield('modalRecover')
    @yield('modalAvatar')
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-8">
                <p>
                    <a class="btn btn-lg btn-success" data-toggle="modal" data-target=".jq-login" ><i class="ion-log-in"></i>  Iniciar Sesi&oacute;n</a>
                    <!--<a class="btn btn-lg btn-primary" data-toggle="modal" data-target=".jq-register" ><i class="ion-person-add"></i>  Registrarse</a>-->
                </p>
                <h2><i class="ion-images"></i>Bienvenidos a barrioOS</h2>
            </div>
            <div class="col-lg-4">
                <h5>Ingresa a la Plataforma de tu barrio o localida</h5>
                @yield("registerForm")
            </div>
        </div>
    </div>
@stop