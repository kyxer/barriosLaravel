@include('frontend.forms.avatar')
@include('frontend.forms.updateUser')
@include('frontend.forms.changePassword')
@extends('frontend.app')
@section('content')
    <div class="container-fluid title">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Perfil</h1>
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active">Perfil</li>
                </ol>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-lg-offset-2">
            @yield('avatarForm')
        </div>
        <div class="col-lg-7">

                @if(Auth::user()->is_verify == 0 && !session()->has('send_verify_manual'))
                    @include('frontend.forms.verify')
                    <div id="jq-container-verify" class="alert alert-dismissible alert-info" >
                        <button type="button" class="close jq-verify-alert">×</button>
                        <div >
                            <strong>Atencion!</strong>  Aun falta verificar su cuenta revisa tu correo!.
                            <br>¿No te ha llegado el correo? @yield('verifyForm')
                        </div>
                    </div>
                @elseif(Auth::user()->is_verify == 0 && session()->has('send_verify_manual'))
                    @include('frontend.forms.verify')
                    <div id="jq-container-verify" class="alert alert-dismissible alert-info" style="display:none" >
                        <button type="button" class="close jq-verify-alert" >×</button>
                        <div >
                            <strong>Atencion!</strong>  Aun falta verificar su cuenta revisa tu correo!.
                            <br>¿No te ha llegado el correo? @yield('verifyForm')
                        </div>
                    </div>
                @endif
                    @if(session()->has('send_verify_manual_check'))
                        <div  class="alert alert-dismissible alert-success" >
                            <button type="button" class="close" data-dismiss="alert" >×</button>
                            <div >
                                <strong>Excelente!</strong> Hemos enviado un correo de verificación.
                            </div>
                        </div>
                    @endif

                    @yield('updateUserForm')
                    <br><br>
                    @yield('changePasswordForm')

        </div>
    </div>
    <br>
@stop