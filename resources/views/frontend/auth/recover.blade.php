@include('frontend.forms.recover')
@extends('frontend.app')
@section('content')
<div class="container-fluid title">
    <div class="container form">
        <h1 class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">Recuperar Contraseña</h1>
    </div>
</div>
<section class="wrapper-3">
  <div class="container">
    <div class="row form">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <p>Ingresa el correo electrónico con el cual te registaste.</p>
            @yield('recoverForm')
        </div>
    </div>
  </div>
</section>
@stop